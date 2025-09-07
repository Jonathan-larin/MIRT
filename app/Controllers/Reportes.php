<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RentaModel;
use App\Models\ServicioModel;
use App\Models\MotocicletaModel;
use App\Models\ClienteModel;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class Reportes extends BaseController
{
    protected $rentaModel;
    protected $servicioModel;
    protected $motocicletaModel;
    protected $clienteModel;

    public function __construct()
    {
        $this->rentaModel = new RentaModel();
        $this->servicioModel = new ServicioModel();
        $this->motocicletaModel = new MotocicletaModel();
        $this->clienteModel = new ClienteModel();
    }

    public function index()
    {
        $data = [
            'current_date' => date('d/m/Y'),
            'stats' => $this->getSystemStats()
        ];

        return view('reportes/index', $data);
    }

    /**
     * Get system statistics for dashboard
     */
    private function getSystemStats()
    {
        return [
            'total_motorcycles' => count($this->motocicletaModel->findAll()),
            'available_motorcycles' => count($this->rentaModel->getAvailableMotorcycles()),
            'rented_motorcycles' => count($this->rentaModel->getActiveRentals()),
            'active_services' => count($this->servicioModel->where('estado_servicio', 'pendiente')->orWhere('estado_servicio', 'en_progreso')->findAll()),
            'completed_services' => count($this->servicioModel->where('estado_servicio', 'completado')->findAll()),
            'total_clients' => count($this->clienteModel->getAllClients())
        ];
    }

    /**
     * Generate PDF report for available motorcycles
     */
    public function generateAvailableMotorcyclesReport()
    {
        $motorcycles = $this->rentaModel->getAvailableMotorcycles();

        $html = $this->generateMotorcyclesReportHTML($motorcycles, 'MOTOCICLETAS DISPONIBLES', 'Listado de motocicletas disponibles para alquiler');

        return $this->generatePDF($html, 'motocicletas_disponibles_' . date('Y-m-d'));
    }

    /**
     * Generate PDF report for leased motorcycles
     */
    public function generateLeasedMotorcyclesReport()
    {
        $rentals = $this->rentaModel->getActiveRentals();

        $html = $this->generateRentalsReportHTML($rentals, 'MOTOCICLETAS ALQUILADAS', 'Listado de motocicletas actualmente alquiladas');

        return $this->generatePDF($html, 'motocicletas_alquiladas_' . date('Y-m-d'));
    }

    /**
     * Generate PDF report for active services
     */
    public function generateActiveServicesReport()
    {
        $services = $this->servicioModel->select('servicios.*, motos.placa, motos.modelo, marca.marca as nombre_marca')
                                       ->join('motos', 'motos.placa = servicios.placa_motocicleta')
                                       ->join('marca', 'marca.idmarca = motos.idmarca')
                                       ->whereIn('estado_servicio', ['pendiente', 'en_progreso'])
                                       ->findAll();

        $html = $this->generateServicesReportHTML($services, 'SERVICIOS ACTIVOS', 'Listado de servicios en proceso o pendientes');

        return $this->generatePDF($html, 'servicios_activos_' . date('Y-m-d'));
    }

    /**
     * Generate PDF report for historical services
     */
    public function generateHistoricalServicesReport()
    {
        $services = $this->servicioModel->select('servicios.*, motos.placa, motos.modelo, marca.marca as nombre_marca')
                                       ->join('motos', 'motos.placa = servicios.placa_motocicleta')
                                       ->join('marca', 'marca.idmarca = motos.idmarca')
                                       ->whereIn('estado_servicio', ['completado', 'cancelado'])
                                       ->findAll();

        $html = $this->generateServicesReportHTML($services, 'HISTORIAL DE SERVICIOS', 'Historial completo de servicios realizados');

        return $this->generatePDF($html, 'historial_servicios_' . date('Y-m-d'));
    }

    /**
     * Generate comprehensive system report
     */
    public function generateSystemReport()
    {
        $stats = $this->getSystemStats();
        $recentRentals = $this->rentaModel->getActiveRentals();
        $recentServices = $this->servicioModel->select('servicios.*, motos.placa, motos.modelo')
                                             ->join('motos', 'motos.placa = servicios.placa_motocicleta')
                                             ->orderBy('created_at', 'DESC')
                                             ->limit(10)
                                             ->findAll();

        $html = $this->generateSystemReportHTML($stats, $recentRentals, $recentServices);

        return $this->generatePDF($html, 'reporte_sistema_' . date('Y-m-d'));
    }

    /**
     * Generate HTML for motorcycles report
     */
    private function generateMotorcyclesReportHTML($motorcycles, $title, $subtitle)
    {
        $html = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { text-align: center; border-bottom: 2px solid #0D3850; padding-bottom: 10px; margin-bottom: 20px; }
                .logo { font-size: 24px; font-weight: bold; color: #0D3850; }
                .title { font-size: 18px; font-weight: bold; color: #0D3850; margin: 10px 0; }
                .subtitle { font-size: 14px; color: #666; margin-bottom: 20px; }
                .date { text-align: right; font-size: 12px; color: #666; margin-bottom: 20px; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f5f5f5; font-weight: bold; }
                .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #666; }
                .stats { background-color: #f9f9f9; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="logo">MI RENTA TOTAL</div>
                <div class="title">' . $title . '</div>
                <div class="subtitle">' . $subtitle . '</div>
            </div>
            <div class="date">Fecha de generación: ' . date('d/m/Y H:i') . '</div>
            <div class="stats">
                <strong>Total de motocicletas: ' . count($motorcycles) . '</strong>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($motorcycles as $moto) {
            $html .= '
                    <tr>
                        <td>' . esc($moto['placa']) . '</td>
                        <td>' . esc($moto['nombre_marca']) . '</td>
                        <td>' . esc($moto['modelo']) . '</td>
                        <td>' . esc($moto['año']) . '</td>
                        <td>' . esc($moto['nombre_estado']) . '</td>
                    </tr>';
        }

        $html .= '
                </tbody>
            </table>
            <div class="footer">
                Reporte generado por MI RENTA TOTAL - ' . date('d/m/Y H:i') . '
            </div>
        </body>
        </html>';

        return $html;
    }

    /**
     * Generate HTML for rentals report
     */
    private function generateRentalsReportHTML($rentals, $title, $subtitle)
    {
        $html = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { text-align: center; border-bottom: 2px solid #0D3850; padding-bottom: 10px; margin-bottom: 20px; }
                .logo { font-size: 24px; font-weight: bold; color: #0D3850; }
                .title { font-size: 18px; font-weight: bold; color: #0D3850; margin: 10px 0; }
                .subtitle { font-size: 14px; color: #666; margin-bottom: 20px; }
                .date { text-align: right; font-size: 12px; color: #666; margin-bottom: 20px; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f5f5f5; font-weight: bold; }
                .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #666; }
                .stats { background-color: #f9f9f9; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="logo">MI RENTA TOTAL</div>
                <div class="title">' . $title . '</div>
                <div class="subtitle">' . $subtitle . '</div>
            </div>
            <div class="date">Fecha de generación: ' . date('d/m/Y H:i') . '</div>
            <div class="stats">
                <strong>Total de alquileres activos: ' . count($rentals) . '</strong>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Marca/Modelo</th>
                        <th>Cliente</th>
                        <th>Fecha Entrega</th>
                        <th>Fecha Renovación</th>
                        <th>Renta (sin IVA)</th>
                        <th>Renta (con IVA)</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($rentals as $rental) {
            $html .= '
                    <tr>
                        <td>' . esc($rental['placa']) . '</td>
                        <td>' . esc($rental['nombre_marca']) . ' ' . esc($rental['modelo']) . ' (' . esc($rental['año']) . ')</td>
                        <td>' . esc($rental['nombre_cliente']) . '</td>
                        <td>' . date('d/m/Y', strtotime($rental['fecha_entrega'])) . '</td>
                        <td>' . date('d/m/Y', strtotime($rental['fecha_renovacion'])) . '</td>
                        <td>$' . number_format($rental['renta_sinIva'], 2) . '</td>
                        <td>$' . number_format($rental['renta_conIva'], 2) . '</td>
                    </tr>';
        }

        $html .= '
                </tbody>
            </table>
            <div class="footer">
                Reporte generado por MI RENTA TOTAL - ' . date('d/m/Y H:i') . '
            </div>
        </body>
        </html>';

        return $html;
    }

    /**
     * Generate HTML for services report
     */
    private function generateServicesReportHTML($services, $title, $subtitle)
    {
        $html = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { text-align: center; border-bottom: 2px solid #0D3850; padding-bottom: 10px; margin-bottom: 20px; }
                .logo { font-size: 24px; font-weight: bold; color: #0D3850; }
                .title { font-size: 18px; font-weight: bold; color: #0D3850; margin: 10px 0; }
                .subtitle { font-size: 14px; color: #666; margin-bottom: 20px; }
                .date { text-align: right; font-size: 12px; color: #666; margin-bottom: 20px; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f5f5f5; font-weight: bold; }
                .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #666; }
                .stats { background-color: #f9f9f9; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="logo">MI RENTA TOTAL</div>
                <div class="title">' . $title . '</div>
                <div class="subtitle">' . $subtitle . '</div>
            </div>
            <div class="date">Fecha de generación: ' . date('d/m/Y H:i') . '</div>
            <div class="stats">
                <strong>Total de servicios: ' . count($services) . '</strong>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Marca/Modelo</th>
                        <th>Tipo de Servicio</th>
                        <th>Estado</th>
                        <th>Fecha Solicitud</th>
                        <th>Costo Estimado</th>
                        <th>Costo Real</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($services as $service) {
            $html .= '
                    <tr>
                        <td>' . esc($service['placa']) . '</td>
                        <td>' . esc($service['nombre_marca']) . ' ' . esc($service['modelo']) . '</td>
                        <td>' . esc($service['tipo_servicio']) . '</td>
                        <td>' . esc($service['estado_servicio']) . '</td>
                        <td>' . date('d/m/Y', strtotime($service['fecha_solicitud'])) . '</td>
                        <td>$' . number_format($service['costo_estimado'] ?? 0, 2) . '</td>
                        <td>$' . number_format($service['costo_real'] ?? 0, 2) . '</td>
                    </tr>';
        }

        $html .= '
                </tbody>
            </table>
            <div class="footer">
                Reporte generado por MI RENTA TOTAL - ' . date('d/m/Y H:i') . '
            </div>
        </body>
        </html>';

        return $html;
    }

    /**
     * Generate HTML for system report
     */
    private function generateSystemReportHTML($stats, $recentRentals, $recentServices)
    {
        $html = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { text-align: center; border-bottom: 2px solid #0D3850; padding-bottom: 10px; margin-bottom: 20px; }
                .logo { font-size: 24px; font-weight: bold; color: #0D3850; }
                .title { font-size: 18px; font-weight: bold; color: #0D3850; margin: 10px 0; }
                .subtitle { font-size: 14px; color: #666; margin-bottom: 20px; }
                .date { text-align: right; font-size: 12px; color: #666; margin-bottom: 20px; }
                .stats { background-color: #f9f9f9; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
                .stats-grid { display: table; width: 100%; margin-bottom: 20px; }
                .stats-item { display: table-cell; padding: 10px; text-align: center; background-color: #fff; border: 1px solid #ddd; margin: 5px; }
                .stats-number { font-size: 24px; font-weight: bold; color: #0D3850; }
                .stats-label { font-size: 12px; color: #666; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f5f5f5; font-weight: bold; }
                .section { margin-top: 30px; }
                .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #666; }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="logo">MI RENTA TOTAL</div>
                <div class="title">REPORTE GENERAL DEL SISTEMA</div>
                <div class="subtitle">Resumen completo del estado actual del sistema</div>
            </div>
            <div class="date">Fecha de generación: ' . date('d/m/Y H:i') . '</div>

            <div class="stats">
                <h3 style="margin-bottom: 15px; color: #0D3850;">ESTADÍSTICAS GENERALES</h3>
                <div class="stats-grid">
                    <div class="stats-item">
                        <div class="stats-number">' . $stats['total_motorcycles'] . '</div>
                        <div class="stats-label">Total Motocicletas</div>
                    </div>
                    <div class="stats-item">
                        <div class="stats-number">' . $stats['available_motorcycles'] . '</div>
                        <div class="stats-label">Disponibles</div>
                    </div>
                    <div class="stats-item">
                        <div class="stats-number">' . $stats['rented_motorcycles'] . '</div>
                        <div class="stats-label">Alquiladas</div>
                    </div>
                    <div class="stats-item">
                        <div class="stats-number">' . $stats['active_services'] . '</div>
                        <div class="stats-label">Servicios Activos</div>
                    </div>
                    <div class="stats-item">
                        <div class="stats-number">' . $stats['completed_services'] . '</div>
                        <div class="stats-label">Servicios Completados</div>
                    </div>
                    <div class="stats-item">
                        <div class="stats-number">' . $stats['total_clients'] . '</div>
                        <div class="stats-label">Total Clientes</div>
                    </div>
                </div>
            </div>

            <div class="section">
                <h3 style="color: #0D3850; border-bottom: 1px solid #ddd; padding-bottom: 5px;">ALQUILERES ACTIVOS RECIENTES</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Placa</th>
                            <th>Cliente</th>
                            <th>Fecha Entrega</th>
                            <th>Fecha Renovación</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach (array_slice($recentRentals, 0, 5) as $rental) {
            $html .= '
                        <tr>
                            <td>' . esc($rental['placa']) . '</td>
                            <td>' . esc($rental['nombre_cliente']) . '</td>
                            <td>' . date('d/m/Y', strtotime($rental['fecha_entrega'])) . '</td>
                            <td>' . date('d/m/Y', strtotime($rental['fecha_renovacion'])) . '</td>
                        </tr>';
        }

        $html .= '
                    </tbody>
                </table>
            </div>

            <div class="section">
                <h3 style="color: #0D3850; border-bottom: 1px solid #ddd; padding-bottom: 5px;">SERVICIOS RECIENTES</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Placa</th>
                            <th>Tipo de Servicio</th>
                            <th>Estado</th>
                            <th>Fecha Solicitud</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach (array_slice($recentServices, 0, 5) as $service) {
            $html .= '
                        <tr>
                            <td>' . esc($service['placa']) . '</td>
                            <td>' . esc($service['tipo_servicio']) . '</td>
                            <td>' . esc($service['estado_servicio']) . '</td>
                            <td>' . date('d/m/Y', strtotime($service['fecha_solicitud'])) . '</td>
                        </tr>';
        }

        $html .= '
                    </tbody>
                </table>
            </div>

            <div class="footer">
                Reporte generado por MI RENTA TOTAL - ' . date('d/m/Y H:i') . '
            </div>
        </body>
        </html>';

        return $html;
    }

    /**
     * Generate and download PDF
     */
    private function generatePDF($html, $filename)
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream($filename . '.pdf', ['Attachment' => true]);
    }
}

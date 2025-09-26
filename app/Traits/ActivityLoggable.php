<?php

namespace App\Traits;

use App\Models\ActivityLogModel;

trait ActivityLoggable
{
    protected $activityLogModel;

    protected function initializeActivityLog()
    {
        if (!isset($this->activityLogModel)) {
            $this->activityLogModel = new \App\Models\ActivityLogModel();
        }
    }

    /**
     * Override insert method to log activity
     */
    public function insert($data = null, bool $returnID = true)
    {
        $result = parent::insert($data, $returnID);

        if ($result !== false) {
            $userId = session()->get('idUsuario') ?? null;
            $this->activityLogModel->logActivity(
                $this->table,
                $result,
                'INSERT',
                null,
                $data,
                $userId
            );
        }

        return $result;
    }

    /**
     * Override update method to log activity
     */
    public function update($id = null, $data = null): bool
    {
        // Get old data before update
        $oldData = null;
        if ($id !== null) {
            $oldData = $this->find($id);
        }

        $result = parent::update($id, $data);

        if ($result) {
            $userId = session()->get('idUsuario') ?? null;
            $this->activityLogModel->logActivity(
                $this->table,
                $id,
                'UPDATE',
                $oldData,
                $data,
                $userId
            );
        }

        return $result;
    }

    /**
     * Override delete method to log activity
     */
    public function delete($id = null, bool $purge = false)
    {
        // Get old data before delete
        $oldData = null;
        if ($id !== null) {
            $oldData = $this->find($id);
        }

        $result = parent::delete($id, $purge);

        if ($result) {
            $userId = session()->get('idUsuario') ?? null;
            $this->activityLogModel->logActivity(
                $this->table,
                $id,
                'DELETE',
                $oldData,
                null,
                $userId
            );
        }

        return $result;
    }
}

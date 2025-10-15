<script>
// Notification functions
function initializeNotifications() {
  // Load initial notification count
  updateNotificationCount();

  // Set up periodic updates every 5 minutes
  setInterval(updateNotificationCount, 300000);

  // Handle notification button click
  const notificationButton = document.getElementById('notificationButton');
  const notificationDropdown = document.getElementById('notificationDropdown');

  if (notificationButton && notificationDropdown) {
    notificationButton.addEventListener('click', (e) => {
      e.stopPropagation();
      toggleNotificationDropdown();
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
      if (!notificationButton.contains(e.target) && !notificationDropdown.contains(e.target)) {
        hideNotificationDropdown();
      }
    });
  }
}

function updateNotificationCount() {
  // Fetch both lease and service notifications, plus activity notifications
  Promise.all([
    fetch('/rentas/expiring-count', {
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
      }
    }),
    fetch('/servicios/upcoming-count', {
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
      }
    }),
    fetch('/notifications/count', {
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
      }
    })
  ])
  .then(responses => Promise.all(responses.map(r => r.json())))
  .then(data => {
    const badge = document.getElementById('notificationBadge');
    const leaseCount = (data[0] && typeof data[0].count === 'number') ? data[0].count : 0;
    const serviceCount = (data[1] && typeof data[1].count === 'number') ? data[1].count : 0;
    const activityCount = (data[2] && typeof data[2].count === 'number') ? data[2].count : 0;
    const totalCount = leaseCount + serviceCount + activityCount;

    if (badge) {
      if (totalCount > 0) {
        badge.textContent = totalCount > 99 ? '99+' : totalCount;
        badge.classList.remove('hidden');
      } else {
        badge.classList.add('hidden');
      }
    }
  })
  .catch(error => {
    console.error('Error updating notification count:', error);
  });
}

function toggleNotificationDropdown() {
  const dropdown = document.getElementById('notificationDropdown');

  if (dropdown) {
    if (dropdown.classList.contains('opacity-0')) {
      showNotificationDropdown();
    } else {
      hideNotificationDropdown();
    }
  }
}

function showNotificationDropdown() {
  const dropdown = document.getElementById('notificationDropdown');
  if (dropdown) {
    dropdown.classList.remove('opacity-0', 'invisible');
    dropdown.classList.add('opacity-100', 'visible');

    // Load notification list
    loadNotificationList();
  }
}

function hideNotificationDropdown() {
  const dropdown = document.getElementById('notificationDropdown');
  if (dropdown) {
    dropdown.classList.remove('opacity-100', 'visible');
    dropdown.classList.add('opacity-0', 'invisible');
  }
}

function loadNotificationList() {
  const notificationList = document.getElementById('notificationList');

  if (!notificationList) return;

  // Show loading
  notificationList.innerHTML = '<div class="text-center py-4 text-gray-500 text-sm"><i class="ri-loader-4-line animate-spin text-xl"></i><p>Cargando...</p></div>';

  // Fetch lease, service, and activity notifications
  Promise.all([
    fetch('/rentas/expiring-leases', {
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
      }
    }),
    fetch('/servicios/upcoming-services', {
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
      }
    }),
    fetch('/notifications/list', {
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
      }
    })
  ])
  .then(responses => Promise.all(responses.map(r => r.json())))
  .then(data => {
    const leaseNotifications = Array.isArray(data[0]) ? data[0] : [];
    const serviceNotifications = Array.isArray(data[1]) ? data[1] : [];
    const activityNotifications = Array.isArray(data[2]) ? data[2] : [];
    const allNotifications = [...leaseNotifications, ...serviceNotifications, ...activityNotifications];

    if (allNotifications && allNotifications.length > 0) {
      renderNotificationList(allNotifications);
    } else {
      notificationList.innerHTML = '<div class="text-center py-4 text-gray-500 text-sm"><i class="ri-notification-off-line text-2xl mb-2"></i><p>No hay notificaciones</p></div>';
    }
  })
  .catch(error => {
    console.error('Error loading notifications:', error);
    notificationList.innerHTML = '<div class="text-center py-4 text-red-500 text-sm"><i class="ri-error-warning-line text-xl mb-2"></i><p>Error al cargar notificaciones</p></div>';
  });
}

function renderNotificationList(notifications) {
  const notificationList = document.getElementById('notificationList');
  if (!notificationList) return;

  let html = '';

  // Separate activity notifications from other notifications
  const activityNotifications = notifications.filter(n => n.type && (n.type === 'motorcycle' || n.type === 'service' || n.type === 'rental'));
  const otherNotifications = notifications.filter(n => !n.type || (n.type !== 'motorcycle' && n.type !== 'service' && n.type !== 'rental'));

  // Sort other notifications by date (earliest first)
  otherNotifications.sort((a, b) => {
    let dateA, dateB;

    if (a.fecha_renovacion) { // Lease notification
      dateA = new Date(a.fecha_renovacion);
    } else if (a.fecha_completado) { // Service with completion date
      dateA = new Date(a.fecha_completado);
    } else if (a.fecha_inicio) { // Service with start date
      dateA = new Date(a.fecha_inicio);
    } else { // Service with request date
      dateA = new Date(a.fecha_solicitud);
    }

    if (b.fecha_renovacion) { // Lease notification
      dateB = new Date(b.fecha_renovacion);
    } else if (b.fecha_completado) { // Service with completion date
      dateB = new Date(b.fecha_completado);
    } else if (b.fecha_inicio) { // Service with start date
      dateB = new Date(b.fecha_inicio);
    } else { // Service with request date
      dateB = new Date(b.fecha_solicitud);
    }

    return dateA - dateB;
  });

  // Sort activity notifications by creation date (newest first)
  activityNotifications.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

  // Combine notifications: activity first, then others
  const sortedNotifications = [...activityNotifications, ...otherNotifications];

  sortedNotifications.forEach(notification => {
    // Check if this is an activity notification
    if (notification.type && (notification.type === 'motorcycle' || notification.type === 'service' || notification.type === 'rental')) {
      // Activity notification
      let linkUrl = '#';
      if (notification.type === 'service') {
        linkUrl = '/servicios';
      } else if (notification.type === 'motorcycle' || notification.type === 'rental') {
        linkUrl = '/motocicletas';
      }

      let iconClass = 'ri-information-line text-blue-600';

      if (notification.title.includes('Nuevo') || notification.title.includes('Agregada') || notification.title.includes('Creado')) {
        iconClass = 'ri-add-circle-line text-green-600';
      } else if (notification.title.includes('Modificada') || notification.title.includes('Actualizada')) {
        iconClass = 'ri-edit-line text-yellow-600';
      } else if (notification.title.includes('Eliminada')) {
        iconClass = 'ri-delete-bin-line text-red-600';
      }

      html += `
        <div class="p-3 border-b border-gray-100 hover:bg-gray-50 cursor-pointer ${notification.is_read ? 'opacity-75' : ''}" onclick="markAsRead(${notification.id}, '${linkUrl}')">
          <div class="flex items-start space-x-3">
            <div class="flex-shrink-0">
              <i class="${iconClass} text-lg"></i>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-sm font-medium text-gray-900">
                ${notification.title}
              </p>
              <p class="text-xs text-gray-600 mt-1">
                ${notification.message}
              </p>
              <p class="text-xs text-gray-500 mt-1">
                ${notification.relative_time}
              </p>
            </div>
            ${!notification.is_read ? '<div class="flex-shrink-0"><div class="w-2 h-2 bg-blue-600 rounded-full"></div></div>' : ''}
          </div>
        </div>
      `;
    } else {
      // Lease or service notification (existing logic)
      let targetDate, dateLabel, linkUrl, typeLabel, clientOrUser;

      if (notification.fecha_renovacion) {
        // Lease notification
        targetDate = new Date(notification.fecha_renovacion);
        dateLabel = 'Vence';
        linkUrl = '/rentas';
        typeLabel = 'Renta';
        clientOrUser = `Cliente: ${notification.nombre_cliente}`;
      } else {
        // Service notification
        if (notification.fecha_inicio && !notification.fecha_completado) {
          targetDate = new Date(notification.fecha_inicio);
          dateLabel = 'Inicia';
          typeLabel = 'Servicio programado';
        } else if (notification.fecha_completado) {
          targetDate = new Date(notification.fecha_completado);
          dateLabel = 'Finaliza';
          typeLabel = 'Servicio por completar';
        } else {
          targetDate = new Date(notification.fecha_solicitud);
          dateLabel = 'Solicitado';
          typeLabel = 'Servicio solicitado';
        }
        linkUrl = '/servicios';
        clientOrUser = `Técnico: Pendiente`;
      }

      const today = new Date();
      const daysDiff = Math.ceil((targetDate - today) / (1000 * 60 * 60 * 24));

      let urgencyClass = 'text-yellow-600';
      let urgencyIcon = 'ri-time-line';

      if (daysDiff <= 1) {
        urgencyClass = 'text-red-600';
        urgencyIcon = 'ri-alarm-warning-line';
      } else if (daysDiff <= 3) {
        urgencyClass = 'text-orange-600';
        urgencyIcon = 'ri-alert-line';
      }

      html += `
        <div class="p-3 border-b border-gray-100 hover:bg-gray-50 cursor-pointer" onclick="window.location.href='${linkUrl}'">
          <div class="flex items-start space-x-3">
            <div class="flex-shrink-0">
              <i class="${urgencyIcon} ${urgencyClass} text-lg"></i>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-sm font-medium text-gray-900 truncate">
                ${notification.nombre_marca} ${notification.modelo}
              </p>
              <p class="text-xs text-gray-500">
                Placa: ${notification.placa_motocicleta || notification.placa}
              </p>
              <p class="text-xs text-gray-500">
                ${typeLabel}: ${notification.tipo_servicio || 'Renta'}
              </p>
              <p class="text-xs text-gray-500">
                ${clientOrUser}
              </p>
              <p class="text-xs ${urgencyClass} font-medium">
                ${dateLabel}: ${targetDate.toLocaleDateString('es-ES')} (${daysDiff} día${daysDiff !== 1 ? 's' : ''})
              </p>
            </div>
          </div>
        </div>
      `;
    }
  });

  notificationList.innerHTML = html;
}

// Function to mark notification as read and redirect
function markAsRead(notificationId, redirectUrl) {
  fetch(`/notifications/mark-read/${notificationId}`, {
    method: 'POST',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      window.location.href = redirectUrl;
    } else {
      console.error('Error marking notification as read');
      window.location.href = redirectUrl;
    }
  })
  .catch(error => {
    console.error('Error:', error);
    window.location.href = redirectUrl;
  });
}

// Initialize notifications when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
  initializeNotifications();
});
</script>

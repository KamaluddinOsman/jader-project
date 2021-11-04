var notificationsWrapper = $('.dropdown-notifications');
var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
var notificationsCountElem = notificationsToggle.find('span[data-count]');
var notificationsCount = parseInt(notificationsCountElem.data('count'));
var notifications = notificationsWrapper.find('div.scroll');

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('new-notification');
// Bind a function to a Event (the full Laravel class)


channel.bind('App\\Events\\NewNotification', function (data) {

    var existingNotifications = notifications.html();
    var newNotificationHtml =
        `<div class="dropdown-divider"></div>
            <a href="`+data.id+`" class="dropdown-item unread">
                <i class="fas fa-envelope mr-2 scrollable-container"></i>
                 `+ data.type + ' ' + data.title + `
                <span  style="font-size: 11px;line-height: 32px;" class="float-right text-muted">` +data.date + `</span>
            </a>

        <div class="dropdown-divider"></div>`;



    notifications.html(newNotificationHtml + existingNotifications);
    notificationsCount += 1;
    notificationsCountElem.attr('data-count', notificationsCount);
    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();


});




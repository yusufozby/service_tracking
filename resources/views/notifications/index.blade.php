
@extends('layouts.app')

@section('title', 'Bildirimler')

@section('content')

<div class="notifications-page">

    {{-- HEADER --}}
    <div class="notifications-header">

        <div class="notifications-title">
            <h1>Bildirimler</h1>
            <p>Servis sisteminizdeki son gelişmeler</p>
        </div>

        <div class="notifications-header-actions">
            <button type="button" class="notifications-read-all">
                Tümünü okundu işaretle
            </button>
        </div>

    </div>


    {{-- FILTERS --}}
    <div class="notifications-toolbar">

        <div class="notification-tabs">

            <form action="{{ route('notifications.filter') }}" method="POST" style="display:inline;">
                @csrf

                <input type="hidden" name="filter" value="all">

                <button type="submit" class="notification-tab active">
                    Tümü

                    <span class="notification-tab-count">
                        {{ $notifications->count() }}
                    </span>
                </button>
            </form>


            <form action="{{ route('notifications.filter') }}" method="POST" style="display:inline;">
                @csrf

                <input type="hidden" name="filter" value="unread">

                <button type="submit" class="notification-tab">
                    Okunmamış

                    <span class="notification-tab-count">
                        {{ $notifications->where('is_read', 0)->count() }}
                    </span>
                </button>
            </form>

        </div>

    </div>


    {{-- NOTIFICATIONS --}}
    <div class="notifications-list">

        @php

            $todayNotifications = $notifications->filter(function ($notification) {
                return $notification->created_at->isToday();
            });

            $yesterdayNotifications = $notifications->filter(function ($notification) {
                return $notification->created_at->isYesterday();
            });

            $olderNotifications = $notifications->filter(function ($notification) {
                return $notification->created_at->lt(
                    now()->startOfDay()->subDay()
                );
            });

        @endphp


        {{-- BUGÜN --}}
        @if($todayNotifications->isNotEmpty())

            <div class="notification-group" data-group="today">

                <div class="notification-group-title">
                    Bugün
                </div>

                @foreach($todayNotifications as $notification)

                    <div
                        class="notification-item {{ $notification->is_read == 0 ? 'unread' : '' }}"
                        onclick="window.location.href='{{ route('notifications.show', $notification->id) }}'"
                    >

                        {{-- ICON --}}
                        @if($notification->type == 'workorder')
                            <div class="notification-icon notification-icon-primary">+</div>

                        @elseif($notification->type == 'critical')
                            <div class="notification-icon notification-icon-danger">!</div>

                        @elseif($notification->type == 'payment')
                            <div class="notification-icon notification-icon-success">₺</div>

                        @else
                            <div class="notification-icon notification-icon-info">📅</div>
                        @endif


                        {{-- CONTENT --}}
                        <div class="notification-content">

                            <div class="notification-top">

                                <h3 class="notification-title">
                                    {{ $notification->title }}
                                </h3>

                                <span class="notification-time">
                                    {{ $notification->created_at->format('H:i') }}
                                </span>

                            </div>


                            <p class="notification-description">
                                {{ $notification->message }}
                            </p>


                            <div class="notification-service">

                                <span class="notification-service-vehicle">
                                    {{ $notification->user->fullname ?? $notification->user->name ?? 'Bilinmeyen Kullanıcı' }}
                                </span>

                            </div>




                        </div>


                        {{-- UNREAD DOT --}}
                        @if($notification->is_read == 0)
                            <span class="notification-unread-dot"></span>
                        @endif

                    </div>

                @endforeach

            </div>

        @endif


        {{-- DÜN --}}
        @if($yesterdayNotifications->isNotEmpty())

            <div class="notification-group">

                <div class="notification-group-title">
                    Dün
                </div>

                @foreach($yesterdayNotifications as $notification)

                    <div
                        class="notification-item {{ $notification->is_read == 0 ? 'unread' : '' }}"
                        onclick="window.location.href='{{ route('notifications.show', $notification) }}'"
                    >

                        {{-- ICON --}}
                        @if($notification->type == 'workorder')
                            <div class="notification-icon notification-icon-primary">+</div>

                        @elseif($notification->type == 'critical')
                            <div class="notification-icon notification-icon-danger">!</div>

                        @elseif($notification->type == 'payment')
                            <div class="notification-icon notification-icon-success">₺</div>

                        @else
                            <div class="notification-icon notification-icon-info">📅</div>
                        @endif


                        {{-- CONTENT --}}
                        <div class="notification-content">

                            <div class="notification-top">

                                <h3 class="notification-title">
                                    {{ $notification->title }}
                                </h3>

                                <span class="notification-time">
                                    Dün {{ $notification->created_at->format('H:i') }}
                                </span>

                            </div>


                            <p class="notification-description">
                                {{ $notification->message }}
                            </p>


                            <div class="notification-service">

                                <span class="notification-service-vehicle">
                                    {{ $notification->user->fullname ?? $notification->user->name ?? 'Bilinmeyen Kullanıcı' }}
                                </span>

                            </div>


                            @include('notifications.partials.type')

                        </div>


                        @if($notification->is_read == 0)
                            <span class="notification-unread-dot"></span>
                        @endif

                    </div>

                @endforeach

            </div>

        @endif


        {{-- DAHA ESKİ --}}
        @if($olderNotifications->isNotEmpty())

            <div class="notification-group" data-group="older">

                <div class="notification-group-title">
                    Daha Eski
                </div>

                @foreach($olderNotifications as $notification)

                    <div
                        class="notification-item {{ $notification->is_read == 0 ? 'unread' : '' }}"
                        onclick="window.location.href='{{ route('notifications.show', $notification->id) }}'"
                    >

                        {{-- ICON --}}
                        @if($notification->type == 'workorder')
                            <div class="notification-icon notification-icon-primary">+</div>

                        @elseif($notification->type == 'critical')
                            <div class="notification-icon notification-icon-danger">!</div>

                        @elseif($notification->type == 'payment')
                            <div class="notification-icon notification-icon-success">₺</div>

                        @else
                            <div class="notification-icon notification-icon-info">📅</div>
                        @endif


                        {{-- CONTENT --}}
                        <div class="notification-content">

                            <div class="notification-top">

                                <h3 class="notification-title">
                                    {{ $notification->title }}
                                </h3>

                                <span class="notification-time">
                                    {{ $notification->created_at->format('d.m.Y') }}
                                </span>

                            </div>


                            <p class="notification-description">
                                {{ $notification->message }}
                            </p>


                            <div class="notification-service">

                                <span class="notification-service-vehicle">
                                    {{ $notification->user->fullname ?? $notification->user->name ?? 'Bilinmeyen Kullanıcı' }}
                                </span>

                            </div>


                            @include('notifications.partials.type')

                        </div>


                        @if($notification->is_read == 0)
                            <span class="notification-unread-dot"></span>
                        @endif

                    </div>

                @endforeach

            </div>

        @endif


        {{-- EMPTY STATE --}}
        @if($notifications->isEmpty())

            <div class="notifications-empty">
                Henüz bir bildiriminiz bulunmuyor.
            </div>

        @endif

    </div>

</div>

@auth
<script>
document.addEventListener('DOMContentLoaded', function () {

    const userId = @json(auth()->id());

    const notificationList = document.querySelector('.notifications-list');

    if (!notificationList || !window.Echo) {
        return;
    }

    window.Echo.private(`App.Models.User.${userId}`)
        .notification(function (notification) {

            console.log('Yeni bildirim:', notification);

            const today = new Date();
            const notificationDate = new Date();

            const data = notification.data ?? notification;

            const title = data.title ?? 'Yeni bildirim';
            const message = data.message ?? '';
            const type = data.type ?? 'info';
            const userName = data.user_name ?? 'Sistem';
            const notificationId = data.id ?? '';

            const time = today.toLocaleTimeString('tr-TR', {
                hour: '2-digit',
                minute: '2-digit'
            });

            // Bildirim ikonunu belirle
            let iconClass = 'notification-icon-info';
            let iconText = '📅';

            if (type === 'workorder') {
                iconClass = 'notification-icon-primary';
                iconText = '+';
            } else if (type === 'critical') {
                iconClass = 'notification-icon-danger';
                iconText = '!';
            } else if (type === 'payment') {
                iconClass = 'notification-icon-success';
                iconText = '₺';
            }

            // Bugün grubu
            let todayGroup = notificationList.querySelector(
                '.notification-group[data-group="today"]'
            );

            if (!todayGroup) {
                todayGroup = document.createElement('div');
                todayGroup.className = 'notification-group';
                todayGroup.dataset.group = 'today';

                const groupTitle = document.createElement('div');
                groupTitle.className = 'notification-group-title';
                groupTitle.textContent = 'Bugün';

                todayGroup.appendChild(groupTitle);
                notificationList.prepend(todayGroup);
            }

            // Bildirim elementi
            const item = document.createElement('div');

            item.className = 'notification-item unread';

            const icon = document.createElement('div');
            icon.className = `notification-icon ${iconClass}`;
            icon.textContent = iconText;

            const content = document.createElement('div');
            content.className = 'notification-content';

            const top = document.createElement('div');
            top.className = 'notification-top';

            const heading = document.createElement('h3');
            heading.className = 'notification-title';
            heading.textContent = title;

            const timeElement = document.createElement('span');
            timeElement.className = 'notification-time';
            timeElement.textContent = time;

            const description = document.createElement('p');
            description.className = 'notification-description';
            description.textContent = message;

            const service = document.createElement('div');
            service.className = 'notification-service';

            const serviceName = document.createElement('span');
            serviceName.className = 'notification-service-vehicle';
            serviceName.textContent = userName;

            const dot = document.createElement('span');
            dot.className = 'notification-unread-dot';

            top.appendChild(heading);
            top.appendChild(timeElement);

            service.appendChild(serviceName);

            content.appendChild(top);
            content.appendChild(description);
            content.appendChild(service);

            item.appendChild(icon);
            item.appendChild(content);
            item.appendChild(dot);

            // Bildirime tıklama
            if (notificationId) {
                item.addEventListener('click', function () {
                    window.location.href =
                        `/notifications/${encodeURIComponent(notificationId)}`;
                });
            }

            // Listenin başına ekle
            todayGroup.insertBefore(item, todayGroup.children[1]);

            // Okunmamış sayacını güncelle
            const unreadTab = document.querySelectorAll('.notification-tab-count')[1];

            if (unreadTab) {
                unreadTab.textContent =
                    Number(unreadTab.textContent) + 1;
            }

            // Tüm bildirim sayacını güncelle
            const allTab = document.querySelectorAll('.notification-tab-count')[0];

            if (allTab) {
                allTab.textContent =
                    Number(allTab.textContent) + 1;
            }

        });

});
</script>
@endauth

@endsection

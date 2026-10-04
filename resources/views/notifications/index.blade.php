@extends('adminlte::page')

@section('title', 'ការជូនដំណឹង')

@section('content_header')
@stop

@section('content')

<div class="notification-page">

    {{-- Header --}}
    <div class="page-header mb-4">
        <div class="header-content">
            <div>
                <div class="header-icon">
                    <i class="fas fa-bell"></i>
                </div>

                <div>
                    <h2>ការជូនដំណឹង</h2>
                    <p>គ្រប់គ្រង និងពិនិត្យការជូនដំណឹងរបស់អ្នក</p>
                </div>
            </div>

            @if($notifications->where('read_at', null)->count() > 0)
                <form action="{{ route('notifications.readAll') }}" method="POST" class="m-0">
                    @csrf

                    <button type="submit" class="btn-read-all">
                        <i class="fas fa-check-double mr-2"></i>
                        សម្គាល់ថាបានអានទាំងអស់
                    </button>
                </form>
            @endif
        </div>
    </div>

    {{-- Notification Card --}}
    <div class="notification-card">

        <div class="card-top">
            <div>
                <h3>
                    <i class="fas fa-list-ul mr-2"></i>
                    ការជូនដំណឹងទាំងអស់
                </h3>

                <span>
                    សារដែលអ្នកបានទទួលពីប្រព័ន្ធ
                </span>
            </div>

            @if($notifications->count() > 0)
                <div class="notification-count">
                    <i class="fas fa-bell mr-1"></i>
                    {{ $notifications->total() }} ការជូនដំណឹង
                </div>
            @endif
        </div>

        <div class="notification-list">

            @forelse($notifications as $notification)

                <div class="notification-item
                    {{ is_null($notification->read_at) ? 'unread' : 'read' }}">

                    {{-- Icon --}}
                    <div class="notification-icon-wrap">
                        <div class="notification-icon">
                            <i class="fas {{ $notification->data['icon'] ?? 'fa-bell' }}
                                {{ $notification->data['color'] ?? 'text-success' }}"></i>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="notification-content">

                        <div class="notification-main">

                            <div class="notification-title">

                                <strong>
                                    {{ $notification->data['title'] ?? 'ការជូនដំណឹង' }}
                                </strong>

                                @if(is_null($notification->read_at))
                                    <span class="new-badge">
                                        ថ្មី
                                    </span>
                                @endif

                            </div>

                            <div class="notification-time">
                                <i class="far fa-clock mr-1"></i>
                                {{ $notification->created_at->diffForHumans() }}
                            </div>

                        </div>

                        <div class="notification-message">
                            {{ $notification->data['message'] ?? '' }}
                        </div>

                        <div class="notification-actions">

                            @if(!empty($notification->data['url']))

                                <a href="{{ $notification->data['url'] }}"
                                   class="btn-detail"
                                   @if(is_null($notification->read_at))
                                       onclick="event.preventDefault(); document.getElementById('read-form-{{ $notification->id }}').submit();"
                                   @endif>

                                    <i class="fas fa-eye mr-1"></i>
                                    មើលលម្អិត
                                </a>

                            @endif

                            @if(is_null($notification->read_at))

                                <form id="read-form-{{ $notification->id }}"
                                      action="{{ route('notifications.read', $notification->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf

                                    @if(empty($notification->data['url']))

                                        <button type="submit" class="btn-mark-read">
                                            <i class="fas fa-check mr-1"></i>
                                            សម្គាល់ថាបានអាន
                                        </button>

                                    @endif

                                </form>

                            @endif

                        </div>

                    </div>

                </div>

            @empty

                {{-- Empty State --}}
                <div class="empty-state">

                    <div class="empty-icon">
                        <i class="fas fa-bell-slash"></i>
                    </div>

                    <h4>មិនទាន់មានការជូនដំណឹងទេ</h4>

                    <p>
                        នៅពេលមានការជូនដំណឹងថ្មី វានឹងបង្ហាញនៅទីនេះ។
                    </p>

                </div>

            @endforelse

        </div>

        {{-- Pagination --}}
        @if($notifications->hasPages())

            <div class="pagination-wrapper">
                {{ $notifications->links() }}
            </div>

        @endif

    </div>

</div>

@endsection


@section('css')

<style>

    :root {
        --hospital-green: #006D36;
        --hospital-dark-green: #00552B;
        --hospital-light-green: #E8F5EE;
        --hospital-bg: #F5F7F6;
        --hospital-border: #E7ECE9;
        --hospital-text: #1F2A24;
        --hospital-muted: #7A8780;
    }

    body {
        background: var(--hospital-bg);
    }

    .notification-page {
        padding: 10px 0 30px;
    }

    /* =========================
       PAGE HEADER
    ========================= */

    .page-header {
        background: linear-gradient(
            135deg,
            #006D36 0%,
            #008747 100%
        );

        border-radius: 16px;
        padding: 24px 28px;
        color: #fff;
        box-shadow: 0 6px 18px rgba(0, 109, 54, 0.12);
    }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .header-content > div:first-child {
        display: flex;
        align-items: center;
    }

    .header-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        font-size: 22px;
    }

    .page-header h2 {
        margin: 0 0 5px;
        font-size: 24px;
        font-weight: 700;
    }

    .page-header p {
        margin: 0;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.82);
    }

    .btn-read-all {
        border: 0;
        background: #fff;
        color: var(--hospital-green);
        padding: 10px 16px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.2s ease;
        white-space: nowrap;
        cursor: pointer;
    }

    .btn-read-all:hover {
        background: #F2F8F5;
        color: var(--hospital-dark-green);
        transform: translateY(-1px);
    }

    /* =========================
       MAIN CARD
    ========================= */

    .notification-card {
        background: #fff;
        border: 1px solid var(--hospital-border);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(31, 42, 36, 0.05);
    }

    .card-top {
        padding: 20px 24px;
        border-bottom: 1px solid var(--hospital-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .card-top h3 {
        margin: 0 0 4px;
        font-size: 17px;
        font-weight: 700;
        color: var(--hospital-text);
    }

    .card-top h3 i {
        color: var(--hospital-green);
    }

    .card-top span {
        font-size: 12px;
        color: var(--hospital-muted);
    }

    .notification-count {
        background: var(--hospital-light-green);
        color: var(--hospital-green);
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* =========================
       NOTIFICATION ITEM
    ========================= */

    .notification-item {
        display: flex;
        align-items: flex-start;
        padding: 20px 24px;
        border-bottom: 1px solid var(--hospital-border);
        transition: all 0.2s ease;
        position: relative;
    }

    .notification-item:last-child {
        border-bottom: 0;
    }

    .notification-item:hover {
        background: #FAFCFB;
    }

    .notification-item.unread {
        background: #F4FAF6;
    }

    .notification-item.unread:hover {
        background: #EEF8F2;
    }

    /* Green line for unread */
    .notification-item.unread::before {
        content: "";
        position: absolute;
        left: 0;
        top: 15px;
        bottom: 15px;
        width: 3px;
        background: var(--hospital-green);
        border-radius: 0 4px 4px 0;
    }

    /* =========================
       ICON
    ========================= */

    .notification-icon-wrap {
        flex: 0 0 auto;
        margin-right: 15px;
    }

    .notification-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--hospital-light-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .notification-icon .text-success,
    .notification-icon .text-primary {
        color: var(--hospital-green) !important;
    }

    /* =========================
       CONTENT
    ========================= */

    .notification-content {
        flex: 1;
        min-width: 0;
    }

    .notification-main {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
    }

    .notification-title {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 7px;
    }

    .notification-title strong {
        color: var(--hospital-text);
        font-size: 14px;
        line-height: 1.5;
    }

    .new-badge {
        display: inline-flex;
        align-items: center;
        background: #D93025;
        color: #fff;
        border-radius: 20px;
        padding: 3px 8px;
        font-size: 9px;
        font-weight: 700;
        line-height: 1.2;
    }

    .notification-time {
        color: var(--hospital-muted);
        font-size: 11px;
        white-space: nowrap;
    }

    .notification-message {
        margin-top: 7px;
        color: #64716A;
        font-size: 13px;
        line-height: 1.7;
    }

    /* =========================
       ACTIONS
    ========================= */

    .notification-actions {
        margin-top: 12px;
    }

    .btn-detail,
    .btn-mark-read {
        display: inline-flex;
        align-items: center;
        border-radius: 8px;
        padding: 7px 11px;
        font-size: 11px;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none !important;
        cursor: pointer;
    }

    .btn-detail {
        background: var(--hospital-green);
        color: #fff !important;
        border: 1px solid var(--hospital-green);
    }

    .btn-detail:hover {
        background: var(--hospital-dark-green);
        border-color: var(--hospital-dark-green);
    }

    .btn-mark-read {
        background: #fff;
        color: var(--hospital-green);
        border: 1px solid #B9D8C6;
    }

    .btn-mark-read:hover {
        background: var(--hospital-light-green);
        border-color: var(--hospital-green);
    }

    /* =========================
       EMPTY STATE
    ========================= */

    .empty-state {
        text-align: center;
        padding: 65px 20px;
    }

    .empty-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: var(--hospital-light-green);
        color: var(--hospital-green);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 27px;
    }

    .empty-state h4 {
        margin: 0 0 7px;
        color: var(--hospital-text);
        font-size: 16px;
        font-weight: 700;
    }

    .empty-state p {
        margin: 0;
        color: var(--hospital-muted);
        font-size: 13px;
    }

    /* =========================
       PAGINATION
    ========================= */

    .pagination-wrapper {
        padding: 18px 24px;
        background: #fff;
        border-top: 1px solid var(--hospital-border);
    }

    .pagination-wrapper .pagination {
        margin: 0;
        justify-content: flex-end;
    }

    .pagination-wrapper .page-link {
        color: var(--hospital-green);
        border-color: var(--hospital-border);
        font-size: 12px;
        border-radius: 7px;
        margin-left: 4px;
    }

    .pagination-wrapper .page-item.active .page-link {
        background: var(--hospital-green);
        border-color: var(--hospital-green);
        color: #fff;
    }

    .pagination-wrapper .page-link:hover {
        background: var(--hospital-light-green);
        border-color: #B9D8C6;
        color: var(--hospital-dark-green);
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 767.98px) {

        .notification-page {
            padding-top: 5px;
        }

        .page-header {
            padding: 20px;
            border-radius: 14px;
        }

        .header-content {
            align-items: flex-start;
            flex-direction: column;
        }

        .header-content > div:first-child {
            width: 100%;
        }

        .btn-read-all {
            width: 100%;
        }

        .card-top {
            padding: 18px;
            align-items: flex-start;
            flex-direction: column;
        }

        .notification-item {
            padding: 17px 18px;
        }

        .notification-main {
            flex-direction: column;
            gap: 5px;
        }

        .notification-time {
            white-space: normal;
        }

        .pagination-wrapper {
            padding: 15px;
        }

        .pagination-wrapper .pagination {
            justify-content: center;
            flex-wrap: wrap;
        }
    }

    @media (max-width: 575.98px) {

        .header-icon {
            width: 46px;
            height: 46px;
            font-size: 19px;
            margin-right: 12px;
        }

        .page-header h2 {
            font-size: 20px;
        }

        .page-header p {
            font-size: 11px;
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }

        .notification-icon-wrap {
            margin-right: 11px;
        }

        .notification-title strong {
            font-size: 13px;
        }

        .notification-message {
            font-size: 12px;
        }
    }

</style>

@stop
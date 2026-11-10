@extends('layouts.app')

@section('title', 'Contact Messages | CraftCeylon')

@section('content')

<style>
    .messages-page {
        background: #f8f6ef;
        min-height: 80vh;
        padding: 50px 0;
    }

    .messages-container {
        max-width: 1200px;
        margin: auto;
        padding: 0 20px;
    }

    .messages-title {
        font-family: Georgia, serif;
        color: #254b36;
        font-size: 36px;
    }

    .messages-card {
        background: white;
        border-radius: 14px;
        padding: 28px;
        box-shadow: 0 8px 30px rgba(0,0,0,.05);
    }

    .messages-table th {
        background: #254b36;
        color: white;
        font-weight: 500;
        padding: 15px;
        white-space: nowrap;
    }

    .messages-table td {
        padding: 15px;
        vertical-align: middle;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-new {
        background: #fff1d6;
        color: #9a6500;
    }

    .status-read {
        background: #e3efff;
        color: #245b9b;
    }

    .status-replied {
        background: #e0f2e5;
        color: #27643b;
    }

    .view-btn {
        background: #254b36;
        color: white;
        padding: 7px 15px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
    }

    .view-btn:hover {
        background: #b18a4a;
        color: white;
    }

    .empty-messages {
        padding: 50px 20px;
        text-align: center;
        color: #777;
    }
</style>

<div class="messages-page">

    <div class="messages-container">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

            <div>
                <h1 class="messages-title">Contact Messages</h1>
                <p class="text-muted mb-0">
                    View and manage messages received from customers.
                </p>
            </div>

            <a href="{{ route('admin.categories.index') }}"
               class="btn btn-outline-success">
                ← Back to Dashboard
            </a>

        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="messages-card">

            <div class="d-flex justify-content-between mb-4 flex-wrap gap-2">
                <h5 class="mb-0" style="color:#254b36;">
                    All Messages
                </h5>

                <span class="text-muted">
                    Total: {{ $messages->total() }} messages
                </span>
            </div>

            @if($messages->count() > 0)

                <div class="table-responsive">

                    <table class="table messages-table table-hover">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($messages as $message)

                                <tr>

                                    <td>{{ $message->id }}</td>

                                    <td class="fw-semibold">
                                        {{ $message->name }}
                                    </td>

                                    <td>{{ $message->email }}</td>

                                    <td>{{ $message->subject }}</td>

                                    <td>
                                        {{ $message->created_at->format('d M Y') }}
                                    </td>

                                    <td>
                                        <span class="status-badge
                                            @if($message->status === 'New')
                                                status-new
                                            @elseif($message->status === 'Read')
                                                status-read
                                            @else
                                                status-replied
                                            @endif">

                                            {{ $message->status }}

                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.contact-messages.show', $message->id) }}"
                                           class="view-btn">
                                            View Message
                                        </a>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="mt-4">
                    {{ $messages->links() }}
                </div>

            @else

                <div class="empty-messages">
                    <h5>No Messages Yet</h5>
                    <p>Customer messages will appear here.</p>
                </div>

            @endif

        </div>

    </div>

</div>

@endsection

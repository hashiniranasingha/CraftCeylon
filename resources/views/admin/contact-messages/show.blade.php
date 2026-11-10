@extends('layouts.app')

@section('title', 'Message Details | CraftCeylon')

@section('content')

<style>
    .message-details-page {
        background: #f8f6ef;
        min-height: 80vh;
        padding: 50px 0;
    }

    .details-container {
        max-width: 950px;
        margin: auto;
        padding: 0 20px;
    }

    .details-title {
        font-family: Georgia, serif;
        color: #254b36;
        font-size: 36px;
    }

    .details-card {
        background: white;
        padding: 35px;
        border-radius: 14px;
        box-shadow: 0 8px 30px rgba(0,0,0,.05);
    }

    .detail-label {
        color: #777;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .detail-value {
        color: #263c2e;
        font-size: 16px;
        font-weight: 500;
        overflow-wrap: anywhere;
    }

    .message-content {
        background: #f8f6ef;
        border-radius: 10px;
        padding: 22px;
        line-height: 1.8;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
    }

    .update-btn {
        background: #254b36;
        color: white;
        border: none;
        padding: 11px 25px;
        border-radius: 7px;
    }

    .update-btn:hover {
        background: #b18a4a;
        color: white;
    }
</style>

<div class="message-details-page">

    <div class="details-container">

        <div class="mb-4">
            <h1 class="details-title">Message Details</h1>
            <p class="text-muted">
                Read and manage the customer message.
            </p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="details-card">

            <div class="row g-4 mb-4">

                <div class="col-md-6">
                    <div class="detail-label">Customer Name</div>
                    <div class="detail-value">
                        {{ $contactMessage->name }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-label">Email Address</div>
                    <div class="detail-value">
                        {{ $contactMessage->email }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-label">Subject</div>
                    <div class="detail-value">
                        {{ $contactMessage->subject }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-label">Received Date</div>
                    <div class="detail-value">
                        {{ $contactMessage->created_at->format('d M Y, h:i A') }}
                    </div>
                </div>

            </div>

            <hr>

            <div class="mb-4">
                <div class="detail-label mb-2">Customer Message</div>

                <div class="message-content">{{ $contactMessage->message }}</div>
            </div>

            <hr>

            <h5 class="mb-3" style="color:#254b36;">
                Update Message Status
            </h5>

            <form action="{{ route('admin.contact-messages.update', $contactMessage->id) }}"
                  method="POST">

                @csrf
                @method('PATCH')

                <div class="row align-items-end g-3">

                    <div class="col-md-7">

                        <label class="form-label fw-semibold">
                            Message Status
                        </label>

                        <select name="status" class="form-select" required>

                            <option value="New"
                                {{ $contactMessage->status === 'New' ? 'selected' : '' }}>
                                New
                            </option>

                            <option value="Read"
                                {{ $contactMessage->status === 'Read' ? 'selected' : '' }}>
                                Read
                            </option>

                            <option value="Replied"
                                {{ $contactMessage->status === 'Replied' ? 'selected' : '' }}>
                                Replied
                            </option>

                        </select>

                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-5">
                        <button type="submit" class="update-btn">
                            Update Status
                        </button>
                    </div>

                </div>

            </form>

            <hr class="my-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <a href="{{ route('admin.contact-messages.index') }}"
                   class="btn btn-outline-secondary">
                    ← Back to Messages
                </a>

                <form action="{{ route('admin.contact-messages.destroy', $contactMessage->id) }}"
                      method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this message?');">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Delete Message
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection

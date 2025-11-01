@extends('layout.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Message Details</h4>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $message->name }}</p>
            <p><strong>Email:</strong> {{ $message->email }}</p>
            <p><strong>Subject:</strong> {{ $message->subject }}</p>
            <p><strong>Message:</strong></p>
            <div class="p-3 bg-light rounded border">{{ $message->message }}</div>
            <p class="mt-3 text-muted"><small>Sent on: {{ $message->created_at->format('Y-m-d H:i') }}</small></p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('messages.index') }}" class="btn btn-secondary">Back to all</a>

            <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this message?')" class="btn btn-danger">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

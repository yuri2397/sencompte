@extends('layouts.admin')

@section('headers')
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('main')
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item active" aria-current="true">Messages</li>

            @if (count($messages) != 0)

            @foreach ($messages as $message)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                  <div class="fw-bold h5 text-dark">{{ $message->message }}</div>
                  Client : {{ $message->client->first_name }} {{ $message->client->last_name }} <br>
                  Date : {{ $message->date }}
                </div>
                <a href="message/delete/{{ $message->id }}" class="btn btn-danger shadow">
                    <span class="badge bg-danger text-white rounded-pill">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                </a>
              </li>
            @endforeach
            @else
            <li class="list-group-item">
                Liste vide
            </li>
            @endif
        </ul>

    </div>
@endsection


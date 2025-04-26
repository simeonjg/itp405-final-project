@extends('layout')

@section('title')
    Invoice #{{ $invoice->InvoiceId }}
@endsection

@section('main')
  <h1>Invoice #{{ $invoice->InvoiceId }}</h1>

  <p>Total: ${{$invoice->Total}}</p>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Track</th>
        <th>Album</th>
        <th>Artist</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
        @foreach($invoice->invoiceItems as $invoiceItem)
          <tr>
            <td>{{$invoiceItem->track->Name}}</td>
            <td>{{$invoiceItem->track->album->Title}}</td>
            <td>{{$invoiceItem->track->album->artist->Name}}</td>
            <td>${{$invoiceItem->UnitPrice}}</td>
          </tr>
        @endforeach
    </tbody>
  </table>
@endsection
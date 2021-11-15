@extends('front.layouts.app')

@section('content')
<main>
    <section class="jumbotron text-center mx-auto" style="width: 400px;">
        <div class="container">
            <h1 class="jumbotron-heading">City Card</h1>
            <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
        </div>
    </section>
    <div style="margin-top: 50px" class="container">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Price</th>
                <th scope="col">User</th>
                <th scope="col">Transport</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <th scope="row">{{$ticket->id}}</th>
                    <td>{{$ticket->price}}</td>
                    <td>{{$ticket->user->name}}</td>
                    <td>{{$ticket->transport->name}}</td>
                    <td>{{$ticket->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="container">
        <h3 class="jumbotron-heading">Add new ticket</h3>
        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="users" class="form-label">User</label>
                <select name="user_id" id="users" class="form-control custom-select">
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" >{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="card_id" class="form-label">Card</label>
                <select name="card_id" id="cards" class="form-control custom-select">
                    @include('front.tickets.inc.selectcard')
                </select>
            </div>
            <div class="mb-3">
                <label for="transport_id" class="form-label">Transport</label>
                <select name="transport_id" class="form-control custom-select">
                    <option value="">Select Transport</option>
                    @foreach($transports as $transport)
                        <option value="{{ $transport->id }}" >{{ $transport->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</main>
@endsection

@push('scripts')
    <script>
        $("#users").change(function(){
            var user_id = $(this).val();
            var token = $("input[name='_token']").val();
            console.log(user_id);

            $.ajax({
                url: "{{ route('tickets.selectcard') }}",
                method: 'POST',
                data: {user_id:user_id, _token:token},
                success: function(data) {
                    $("#cards").html('');
                    $("#cards").html(data.options);
                }
            });
        });
    </script>
@endpush

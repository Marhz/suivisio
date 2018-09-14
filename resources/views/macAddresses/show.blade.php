@foreach($users as $user)
  @foreach($user->macAddresses as $macAddress)
    {{$user->fullName()}};{{ $macAddress->address}}<BR>
  @endforeach
@endforeach

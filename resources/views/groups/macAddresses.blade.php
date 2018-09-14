@foreach($group->users as $user)
  @foreach($user->macAddresses as $macAddress)
    {{$user->fullName()}};{{ $macAddress->address }}
  @endforeach
@endforeach

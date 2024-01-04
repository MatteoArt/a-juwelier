<h1>
    Hi, you have a new watch sale proposal by {{ $data['fullname'] }}</h1>

<div>User details: </div>
<ul>
    <li>Fullname: <strong>{{ $data['fullname'] }}</strong></li>
    <li>Email: <strong>{{ $data['email'] }}</strong></li>
    <li>Phone number: <strong>{{ $data['phone'] }}</strong></li>
    <li>City: @if ($data['city'])
            <strong>{{ $data['city'] }}</strong>
        @else
            <span>//</span>
        @endif
    </li>
    <li>Address: @if ($data['address'])
            <strong>{{ $data['address'] }}</strong>
        @else
            <strong>//</strong>
        @endif
    </li>
</ul>

<h4>Informations about the watch</h4>
<ul>
    @foreach ($labels as $label)
        <li>
            {{ $label }}:
            @if ($data['informations'][$loop->index])
                <strong>{{ $data['informations'][$loop->index] }}</strong>
            @else
                <strong>//</strong>
            @endif
        </li>
    @endforeach
</ul>

<h5>Images: </h5>
@if (isset($data['photo1']))
    <div>
        <img src="{{ asset('/storage/' . $data['photo1']) }}" alt="photo1_watch">
    </div>
@endif

@if (isset($data['photo2']))
    <div>
        <img src="{{ asset('/storage/' . $data['photo2']) }}" alt="photo2_watch">
    </div>
@endif

@if (isset($data['photo3']))
    <div>
        <img src="{{ asset('/storage/' . $data['photo3']) }}" alt="photo3_watch">
    </div>
@endif

<div>User price quote: <strong>{{ $data['price'] }}</strong></div>

@if ($data['note'])
    <div>Message: </div>
    <div>{{ $data['note'] }}</div>
@endif

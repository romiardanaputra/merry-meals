<html>

<head>
    <title> How To Get Current User Location In Laravel 9 </title>
    <style>
        input, button{
            display: block;
            margin: 1rem;
            padding: 1rem;
        }
    </style>
</head>

<body style="text-align: center;">
    <h1> How To Get Current User Location In Laravel 9 </h1>
    <div style="border:1px solid black; margin-left: 300px; margin-right: 300px;">
        <form action="{{ route('store_geolocation') }}" method="post">
            @csrf
            <input type="text" name='ip' value="{{ $data->ip }}" >
            <input type="text" name='countryName' value="{{ $data->countryName }}" >
            <input type="text" name='countryCode' value="{{ $data->countryCode }}" >
            <input type="text" name='regionCode' value="{{ $data->regionCode }}" >
            <input type="text" name='regionName' value="{{ $data->regionName }}" >
            <input type="text" name='cityName' value="{{ $data->cityName }}" >
            <input type="text" name='zipCode' value="{{ $data->zipCode }}" >
            <input type="text" name='latitude' value="{{ $data->latitude }}" >
            <input type="text" name='longitude' value="{{ $data->longitude }}" >
            <button type="submit">submit</button>
        </form>


        <h3>IP: {{ $data->ip }}</h3>
        <h3>Country Name: {{ $data->countryName }}</h3>
        <h3>Country Code: {{ $data->countryCode }}</h3>
        <h3>Region Code: {{ $data->regionCode }}</h3>
        <h3>Region Name: {{ $data->regionName }}</h3>
        <h3>City Name: {{ $data->cityName }}</h3>
        <h3>Zipcode: {{ $data->zipCode }}</h3>
        <h3>Latitude: {{ $data->latitude }}</h3>
        <h3>Longitude: {{ $data->longitude }}</h3>
    </div>
</body>

</html>
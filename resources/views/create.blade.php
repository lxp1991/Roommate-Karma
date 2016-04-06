<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title></title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-
1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<!-- Your	code	goes	here	-->
<select name="location_id">
    @foreach ($locations as $location)
        <option value="{{ $location->id }}”>{{ $location->value }}</option>
    @endforeach
</select>

{{ Form::open(array('url' => 'story/create')) }}
{{ Form::label('location', 'Location') }}
<br>

{{ Form::label('title', 'Title') }}
{{ Form::text('title') }}
<br>
{{ Form::label('story', 'Story') }}
{{ Form::textarea('story') }}
<br>
{{ Form::label('published', 'Published') }}
{{ Form::checkbox('publish', 'publish', true) }}     
<br>
{{Form::submit('Submit')}}

{{ Form::close() }}
<!-- Your	code	goes	here	-->

<script	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
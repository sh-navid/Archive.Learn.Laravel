<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$title}}</title>
</head>
<body>
    <h1>{{$title}}</h1>
    <hr/>
    {{time()}}

    @if (12==13)
        hello
    @else
        goodbye
    @endif
</body>
</html>
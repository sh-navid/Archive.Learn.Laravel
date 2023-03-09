<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        const _=(action, method="GET", data=null)=>{
            $.ajax({
                type: method,
                url: action,
                data: data,
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                success:(data)=> {
                    $("#msg").html(data.msg);
                }
            });
        }
    </script>
</head>
<body>
    <h1>Comments</h1>
    @foreach ($comments as $comment)
        {{$comment->email}}
        <br/>
        <button onclick="_('/comments/{{$comment->id}}','DELETE')">X</button>
        {{$comment->content}}
        <hr/>
    @endforeach

    <form action="/comments" method="post">
        @csrf
        <input type="text" name="email" placeholder="Email"/>
        <input type="text" name="content" placeholder="Content"/>
        <input type="submit" value="Send"/>
    </form>
</body>
</html>
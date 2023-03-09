<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        const ajax=(action, method="GET")=>{
            $.ajax({
                type: method,
                url: action,
                data:'_token = {{csrf_token()}}',
                success:(data)=> {
                    $("#msg").html(data.msg);
                }
            });
        }
    </script>
</head>
<body>
    <h1>Comments</h1>
    @foreach ($collection as $item)
        
    @endforeach
</body>
</html>
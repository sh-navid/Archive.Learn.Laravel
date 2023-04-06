<!DOCTYPE html>
<html lang="en">
<body>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
    const call=()=>{
        $.ajax({
               type:'POST',
               url:'/ajaxcall',
               headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
               success:(data)=> {
                  alert(data);
               }
            });
        }
    </script>
    <button onclick="call()">Click</button>
</body>
</html>
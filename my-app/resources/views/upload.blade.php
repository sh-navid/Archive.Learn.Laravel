<!DOCTYPE html>
<html lang="en">
<body>
    <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="myFile"/>
        <input type="submit"/>
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Candy Market Create Candy Post</title>
</head>
<body>
    <form action="/create" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="imagefile" required/>
        <input type="text" name="title" placeholder="title" required/>
        <input type="text" name="description" placeholder="description" required/>
        <input type="number" name="price" placeholder="price" required/>
        <input type="number" name="amount" placeholder="amount" required/>
        <select name="type" id="type" required>
            <option value="1">KG</option>
            <option value="2">Piece</option>
            <option value="3">Box</option>
        </select>
        <input type="submit" value="Create">
    </form>
</body>
</html>
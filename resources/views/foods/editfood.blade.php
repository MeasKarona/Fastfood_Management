<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> <style>
#Header button {
border-style: none;
padding: 10px 20px 10px 0px;
width: 110px;
border-radius: 10px;
text-align: right;
font-weight: bold;
margin: 5px;
float: right;
}

.green {
color: green;
background-color: #D4F6ED;
}

.yellow {
color: yellow;
background-color: #ffe9b0a1;
}

.red {
color: red;
background-color: #FDE9E6;
}

#Header img {
width: 50px;
height: 50px;
border-radius: 30px;
padding: 0px 10px 10px 0px;
}

#container img {
width: 250px;
height: 250px;
}

#container .title {
padding-top: 25px;
color: #AFAFAF;
font-size: larger;
padding-left: 15px;
font-weight: bold;
}

#container a {
text-decoration: none;
}

#container label {
color: #AFAFAF;
font-size: small;
padding-left: 40px;
font-weight: bold;
}

#Footer button {
width: 300px;
height: 50px;
border-radius: 10px;
border: none;
font-weight: bold;
margin-left: 10px;
}
.food-info-container{
width:50%;
left: 50%;
position: relative;
transform: translate(-50%);
}
</style>

@foreach($data as $data)
<form action="{{ url('update_foodinfo') }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" value='{{ $data-> id}}'>
    <div id="Header" style="margin: 15px 10px 0px 10px;">
    </div>
    <div id="container">
        <img src="../images/{{ $data-> image}}" class="rounded mx-auto d-block" alt="...">
        <div style="text-align: center; font-weight: bold;">
            <input type="file" name="image">
        </div>
        <div id="Info">
            <p class="title">FOOD DETAILS</p>
            <div class="form-group food-info-container">
                <label class="label-control">Food Name</label>
                <input type="text" name="foodname" value='{{ $data-> food_name}}' class="form-control"><br>
            </div>
            <div class="form-group food-info-container">
                <label class="label-control">Category</label>
                <select class="form-control" name="category" value='{{ $data-> category}}'>
                    <option value="Pizza">Pizza</option>
                    <option value="Burger">Burger</option>
                    <option value="Drink">Drink</option>
                </select><br>
            </div>
            <div class="form-group food-info-container">
                <label class="label-control">Price</label>
                <input type="text" name="price" value='{{ $data-> price}}' class="form-control"><br>
            </div>
            <div class="form-group food-info-container">
                <label class="label-control">Description</label>
                <input type="text" name="description" value='{{ $data-> description}}' class="form-control"><br>
            </div>





        </div>
    </div>
    <div id="Footer" style="padding: 10px 33% 0px 33%;">
        <button type="submit" style="color: white; background-color: #292D30;">Save Changes</button>
        <button style="color: #292D30;">Cancel</button>
    </div>


    @endforeach


</form>

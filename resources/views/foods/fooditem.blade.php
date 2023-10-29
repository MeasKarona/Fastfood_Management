<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


<style>
.profilePic{ width:90px; height: 80px; border - radius: 50 %; }
.item-header{
    text-align: center;
}
</style>
    <h1 class="item-header">This is food menu</h1>
    <div> <a href="{{ url('addFood') }}" class="btn btn-primary">Add Food</a> </div>

<table class="table">
    <thead>
    <tr>
        <th>Id</th>
        <th>Image</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Description</th>
        <th>Create By</th>
        <th>Action</th>
        </tr>
    </thead>
                <tbody> @foreach($data as $data) <tr> <td>#</td> <td><img src="../images/{{ $data->image }}"
                    class="profilePic"></td> <td>{{ $data-> food_name}}</td>
                    <td>{{ $data-> category}}</td>
                    <td>{{ $data-> price}}</td>
                    <td>{{ $data-> description}}</td>
                    <td>{{ $data-> create_by}}</td>
                    <td>
                    <a href="{{ url('edit_food/'.$data->id) }}" class="btn btn-warning">Edit</a> |
                    <a href="{{ url('delete_food/'.$data->id) }}" class="btn btn-danger">Delete</a>
                    </td>
                    </tr>

                    @endforeach
                    </tbody>
</table>
<div id="Footer" style="display: flex; justify-content: end; padding-right: 50px;">
    <a style="background-color:gray; width: 300px;height: 50px;border-radius: 10px;font-weight: bold;" class="btn btn-secondary" href="/">Cancel</a>
</div>

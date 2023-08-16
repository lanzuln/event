<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">

                            <input class="d-none" id="updateID">
                            <div class="col-12 p-1">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="update_title">
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Description</label>
                                <textarea class="form-control"  name="description" cols="30" rows="10" id="update_description"></textarea>
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" name="date" id="update_date">
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Time</label>
                                <input type="time" class="form-control" name="time" id="update_time">
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" id="update_location">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn btn-sm  btn-success">Update</button>
            </div>
        </div>
    </div>
</div>


<script>
async function FillUpUpdateForm(id) {
    document.getElementById('updateID').value = id;
    showLoader();
    let res = await axios.post("/event-by-id", { id: id})
    hideLoader();
    document.getElementById('update_title').value = res.data['title'];
    document.getElementById('update_description').value = res.data['description'];
    document.getElementById('update_date').value = res.data['date'];
    document.getElementById('update_time').value = res.data['time'];
    document.getElementById('update_location').value = res.data['location'];

}


async function Update() {

    let updateID = document.getElementById('updateID').value;
    let title = document.getElementById('update_title').value;
    let description = document.getElementById('update_description').value;
    let date = document.getElementById('update_date').value;
    let time = document.getElementById('update_time').value;
    let location = document.getElementById('update_location').value;

    if (title.length === 0) {
        errorToast("Category Required !")
    } else {
        document.getElementById('update-modal-close').click();
        showLoader();
        let res = await axios.post("/update-event", {
            title: title,
            description: description,
            date: date,
            time: time,
            location: location,
            id: updateID
        })
        hideLoader();

        if (res.status === 200 && res.data === 1) {
            document.getElementById("update-form").reset();
            successToast("Request success !")
            await getList();
        } else {
            errorToast("Request fail !")
        }


    }



}
</script>

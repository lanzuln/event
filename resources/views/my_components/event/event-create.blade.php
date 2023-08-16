<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Event</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="title">
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Description</label>
                                <textarea class="form-control"  name="description" cols="30" rows="2" id="description"></textarea>
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" name="date" id="date">
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Time</label>
                                <input type="time" class="form-control" name="time" id="time">
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" id="location">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Save()"  class="btn btn-sm  btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
async function Save() {


    let title = document.getElementById('title').value;
    let description = document.getElementById('description').value;
    let date = document.getElementById('date').value;
    let time = document.getElementById('time').value;
    let location = document.getElementById('location').value;

    if (title.length === 0) {
        errorToast("title Required !")
    }else if (description.length === 0){
        errorToast("description Required !")
    }
    else if (date.length === 0){
        errorToast("date Required !")
    }
    else if (time.length === 0){
        errorToast("time Required !")
    }
    else if (location.length === 0){
        errorToast("location Required !")
    } else {

        document.getElementById('modal-close').click();

        showLoader();
        let res = await axios.post("/create-event", {
            title: title,
            description: description,
            date: date,
            time: time,
            location: location
        })
        hideLoader();

        if (res.status === 201) {

            successToast('Request completed');

            document.getElementById("save-form").reset();

            await getList();
        } else {
            errorToast("Request fail !")
        }
    }
}
</script>

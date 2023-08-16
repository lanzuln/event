<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Event</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-end btn m-0 btn-sm bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-dark " />
                <table class="table" id="tableData">
                    <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Title</th>
                            <th>date</th>
                            <th>Time</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableList">
                        {{--Table Data--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
getList();


async function getList() {

    showLoader();
    let res = await axios.get("/read-event");
    hideLoader();


    let tableData = $('#tableData');
    let tableList = $('#tableList');

    tableData.DataTable().destroy();
    tableList.empty();



    res.data.forEach(function(item, index) {
        let truncatedDescription = item.description.length > 20 ? item.description.substring(0, 30) + '...' : item.description;
        let row = `<tr>
                    <td>${index+1}</td>
                    <td>${item.title}</td>
                    <td>${item.date}</td>
                    <td>${item.time}</td>
                    <td>${item.location }</td>
                    <td>${item.description}</td>
                    <td>
                        <button data-id="${item.id}"  class="btn view btn-sm btn-outline-info">view</button>
                        <button data-id="${item.id}"  class="btn edit btn-sm btn-outline-success">Edit</button>
                        <button data-id="${item.id}"  class="btn delete btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>`;
        tableList.append(row);
    })

    $('.edit').on('click', async function() {
        let id = $(this).data('id');
        await FillUpeventForm(id);
        $("#update-modal").modal('show');
    })

    $('.delete').on('click', function() {
        let id = $(this).data('id');
        $("#delete-modal").modal('show');
        $("#deleteID").val(id);
    })

    $('.view').on('click', async function() {
        let id = $(this).data('id');
        await FillUpUpdateForm(id);
        $("#view-modal").modal('show');
    })




    tableData.DataTable({
        order: [
            [0, 'desc']
        ],
        lengthMenu: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50],
        language: {
            paginate: {
                next: '&#8594;', // or '→'
                previous: '&#8592;' // or '←'
            }
        }
    })
}
</script>

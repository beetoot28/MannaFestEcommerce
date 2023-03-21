<link rel="stylesheet" href="css/navbar.css" />
<script src="../js/navbar.js"></script>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css'
    integrity='sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=='
    crossorigin='anonymous' referrerpolicy='no-referrer' />

<div class="sidebar "> <BR>
    <div class="logo-details">
        <i class='bx bx-sdsds'></i>
        <span class="logo_name"> <img src="../assets/logo/logo_transparent.png" class="img-thumbnnail shadow"
                style="width: 100px;height: 70px;border-radius: 30px;"></span>
    </div>
    <ul class="nav-links">
        <li>
            <a href='index.php'>
                <i class='bx bx-grid-alt'></i>
                <span class="link_name">Delivery</span>
            </a>
            <hr style='color:white'>
        </li>
       
        <li>
            <a href='remit.php'>
                <i class='bx bx-grid-alt'></i>
                <span class="link_name">Remit Cash</span>
            </a>
            <hr style='color:white'>
        </li>




        <li>
            <div class='profile-details'>
                <div class='profile-content'>
                    <img src="../assets/logo/logo_transparent.png" class="img-thumbnnail shadow"
                        style="width: 60px;height: 20px;border-radius: 30px;">
                </div>
                <div class='name-job'>
                    <div class='profile_name'> <a href="profile.php">Rider </a></div>
                    <div class='job'>Administrator</div>
                </div>
                <a href="../log/logout.php">
                    <i class='bx bx-log-in'></i>
                </a>
            </div>
        </li>
    </ul>
</div>

<script>
const activePage = window.location.pathname;
const navLinks = document.querySelectorAll('.sidebar a').forEach(link => {
    if (link.href.includes(`${activePage}`)) {
        link.classList.add('active');
        console.log(activePage);
    }
})


</script>


<!-- Modal -->
<div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Settings</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label style="font-size: 14px" class="mb-1">Reciver Auto Received: </label>
                <select class="form-select mb-2" name="cat" style="font-size: 14px">
                    <option disabled="disabled" selected="selected" value="">Select Category </option>
                    <option  value="">Immidietly </option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
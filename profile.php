<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

$user_email = $_SESSION['user'];
$user_initial = strtoupper(substr($user_email, 0, 1));

// Fetch Real Wishlist Count
$wish_res = mysqli_query($conn, "SELECT COUNT(*) as total FROM wishlist WHERE user_email='$user_email'");
$wish_count = mysqli_fetch_assoc($wish_res)['total'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | Mini Store Elite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root { --primary: #0066cc; --light-gray: #f5f5f7; --dark: #1d1d1f; --gold: #ffcc00; }
        body { background-color: var(--light-gray); font-family: 'SF Pro Display', sans-serif; }
        .navbar { background: rgba(255, 255, 255, 0.8) !important; backdrop-filter: blur(15px); border-bottom: 1px solid rgba(0,0,0,0.05); }
        .glass-card { background: white; border-radius: 30px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
        .profile-avatar { 
            width: 110px; height: 110px; background: linear-gradient(135deg, var(--primary), #00aaff); 
            color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; 
            font-size: 3rem; font-weight: 700; margin: 0 auto 20px; box-shadow: 0 15px 30px rgba(0, 102, 204, 0.2);
        }
        .stat-box { background: #fbfbfb; border-radius: 20px; padding: 20px; transition: 0.3s; text-decoration: none; color: inherit; display: block; cursor: pointer; }
        .stat-box:hover { background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid var(--primary); }
        .recent-item { background: white; border-radius: 20px; padding: 15px; transition: 0.3s; height: 100%; border: 1px solid transparent; }
        .recent-item:hover { border-color: var(--primary); transform: translateY(-5px); }
        
        .star-rating i { color: #ddd; font-size: 0.8rem; margin-right: 2px; }
        .star-rating i.active { color: var(--gold); }
        .btn-rate { font-size: 0.7rem; font-weight: 700; border-radius: 50px; padding: 4px 12px; border: 1px solid #eee; background: #fff; transition: 0.3s; margin-top: 10px; }
        .btn-rate:hover { background: var(--primary); color: white; border-color: var(--primary); }
        .modal-star { cursor: pointer; font-size: 2.5rem; color: #ddd; transition: 0.2s; }
        .modal-star.active { color: var(--gold); transform: scale(1.1); }
        
        .order-item { background: white; border-radius: 20px; padding: 20px; margin-bottom: 15px; }
        .status-pill { font-size: 0.7rem; font-weight: 700; padding: 6px 16px; border-radius: 50px; }
        .status-shipped { background: #e3f2fd; color: #0066cc; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top px-lg-5">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="index.php"><i class="bi bi-cpu-fill text-primary me-2"></i>MINI STORE</a>
            <div class="ms-auto d-flex align-items-center gap-3">
                <a href="index.php" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm">Home</a>
                <a href="wishlist.php" class="text-dark position-relative me-2">
                    <i class="bi bi-heart-fill fs-4 text-danger"></i>
                    <span class="badge rounded-pill bg-dark position-absolute top-0 start-100 translate-middle"><?php echo $wish_count; ?></span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                
                <div class="glass-card text-center mb-5">
                    <div class="profile-avatar"><?php echo $user_initial; ?></div>
                    <h2 class="fw-bold mb-1">Elite Member</h2>
                    <p class="text-muted mb-4"><?php echo $user_email; ?></p>
                    
                    <div class="row g-3 justify-content-center">
                        <div class="col-4">
                            <div class="stat-box">
                                <h4 class="fw-bold mb-0">12</h4>
                                <small>Orders</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <a href="wishlist.php" class="stat-box text-decoration-none">
                                <h4 class="fw-bold mb-0 text-danger"><?php echo $wish_count; ?></h4>
                                <small>Wishlist</small>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="orders.php" class="stat-box text-decoration-none d-block">
                                <i class="bi bi-clock-history fs-4 text-primary"></i>
                                <br><small>History</small>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <h4 class="fw-bold mb-4">Recently Viewed</h4>
                    <div class="row g-3">
                        <?php
                        if (isset($_SESSION['recently_viewed']) && !empty($_SESSION['recently_viewed'])) {
                            $ids = implode(',', $_SESSION['recently_viewed']);
                            $recent_query = mysqli_query($conn, "SELECT * FROM products WHERE id IN ($ids) ORDER BY FIELD(id, $ids)");
                            while ($r_row = mysqli_fetch_assoc($recent_query)) { ?>
                                <div class="col-6 col-md-3">
                                    <div class="recent-item shadow-sm text-center">
                                        <img src="images/<?php echo $r_row['image']; ?>" style="height: 70px; object-fit: contain;" class="mb-2">
                                        <p class="small fw-bold mb-0 text-truncate"><?php echo $r_row['name']; ?></p>
                                        
                                        <div class="star-rating mt-1">
                                            <i class="bi bi-star-fill active"></i><i class="bi bi-star-fill active"></i><i class="bi bi-star-fill active"></i><i class="bi bi-star-fill active"></i><i class="bi bi-star"></i>
                                        </div>
                                        
                                        <button class="btn-rate w-100" onclick="openRatingModal('<?php echo addslashes($r_row['name']); ?>')">Rate Now</button>
                                    </div>
                                </div>
                            <?php }
                        } else { echo "<div class='col-12'><p class='text-muted small'>No items viewed recently.</p></div>"; }
                        ?>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <a href="logout.php" class="btn btn-outline-danger rounded-pill px-5 fw-bold shadow-sm">Logout</a>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="ratingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 25px;">
                <div class="modal-body text-center p-5">
                    <h4 class="fw-bold mb-1">How was your experience?</h4>
                    <p class="text-muted small mb-4" id="modalProductName"></p>
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <i class="bi bi-star-fill modal-star" onclick="setStar(1)" data-value="1"></i>
                        <i class="bi bi-star-fill modal-star" onclick="setStar(2)" data-value="2"></i>
                        <i class="bi bi-star-fill modal-star" onclick="setStar(3)" data-value="3"></i>
                        <i class="bi bi-star-fill modal-star" onclick="setStar(4)" data-value="4"></i>
                        <i class="bi bi-star-fill modal-star" onclick="setStar(5)" data-value="5"></i>
                    </div>
                    <textarea id="reviewText" class="form-control rounded-4 border-0 bg-light mb-4 p-3 shadow-none" rows="3" placeholder="Tell us more about the product..."></textarea>
                    <button class="btn btn-primary w-100 rounded-pill py-3 fw-bold" onclick="submitReview()">Submit Rating</button>
                    <button class="btn btn-link text-muted small mt-2 text-decoration-none" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let selectedStars = 0;
        function openRatingModal(name) {
            document.getElementById('modalProductName').innerText = name;
            selectedStars = 0;
            resetStars();
            new bootstrap.Modal(document.getElementById('ratingModal')).show();
        }
        function setStar(val) {
            selectedStars = val;
            const stars = document.querySelectorAll('.modal-star');
            stars.forEach((s, i) => { if (i < val) s.classList.add('active'); else s.classList.remove('active'); });
        }
        function resetStars() {
            document.querySelectorAll('.modal-star').forEach(s => s.classList.remove('active'));
            document.getElementById('reviewText').value = '';
        }
        function submitReview() {
            if (selectedStars === 0) { Swal.fire({ icon: 'warning', title: 'Oops!', text: 'Please select a star rating first.' }); return; }
            Swal.fire({ icon: 'success', title: 'Review Submitted!', text: 'Thank you for your valuable feedback.', confirmButtonColor: '#0066cc' }).then(() => { location.reload(); });
        }
    </script>
</body>
</html>

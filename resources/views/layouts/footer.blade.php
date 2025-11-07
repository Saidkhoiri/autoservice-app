<footer class="footer-custom text-center py-4 mt-5">
    <div class="container">
        <p class="mb-1 fw-semibold">&copy; {{ date('Y') }} <span class="brand">AutoServis</span>. All rights reserved.</p>
        <small class="d-block">Dibuat dengan <span class="love-icon">❤</span> oleh <strong>Said Efendi</strong></small>
    </div>
</footer>

<style>
.footer-custom {
    background: linear-gradient(135deg, #5b2be0, #7a42f5, #5e35b1);
    color: #ffffff;
    text-align: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    letter-spacing: 0.3px;
    box-shadow: 0 -4px 12px rgba(91, 43, 224, 0.2);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    margin-left: 250px;
    transition: margin-left 0.3s ease;
}

.footer-custom .brand {
    color: #ffeb3b;
}

.footer-custom p,
.footer-custom small {
    margin: 0;
}

.footer-custom small {
    opacity: 0.9;
    font-size: 0.9rem;
}

.footer-custom a {
    color: #ffe57f;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.footer-custom a:hover {
    color: #ffffff;
    text-decoration: underline;
}
.love-icon {
    color: #f08fbfff;
    font-size: 1.1rem;
}
</style>
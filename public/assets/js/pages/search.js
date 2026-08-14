// PUMI — Tìm kiếm sản phẩm (client-side, không cần backend)
(function () {
    "use strict";

    var PRODUCTS = window.PRODUCTS_DATA || [
        { name: "Dung dịch vệ sinh cho bé", cat: "Dung dịch vệ sinh cho bé", href: "dung-dich-ve-sinh-cho-be-pro14.html", img: "assets/images/upload/product/thumbs/img_68db4f7810eb3.png", desc: "Giúp làm sạch nhẹ nhàng, khử mùi hôi, làm dịu da bé khi bị rôm sảy, hăm da, mẩn ngứa." },
        { name: "Dung dịch vệ sinh cho bé", cat: "Dung dịch vệ sinh cho bé", href: "dung-dich-ve-sinh-cho-be-pro13.html", img: "assets/images/upload/product/thumbs/img_68ddda7c9a06e.png", desc: "Giúp làm sạch nhẹ nhàng, khử mùi hôi, làm dịu da bé khi bị rôm sảy, hăm da, mẩn ngứa." },
        { name: "Dung dịch vệ sinh cho bé", cat: "Dung dịch vệ sinh cho bé", href: "dung-dich-ve-sinh-cho-be-pro12.html", img: "assets/images/upload/product/thumbs/img_68db4f93f32fc.png", desc: "Hương mùa xuân & Vương Quốc Hạnh Phúc." },
        { name: "Nước tắm thảo dược", cat: "Nước tắm thảo dược", href: "nuoc-tam-thao-duoc-pro11.html", img: "assets/images/upload/product/thumbs/img_68da996a88715.png", desc: "Giúp làm sạch dịu nhẹ, cải thiện tình trạng rôm sảy, hăm da, mẩn ngứa." },
        { name: "Nước tắm thảo dược", cat: "Nước tắm thảo dược", href: "nuoc-tam-thao-duoc-pro10.html", img: "assets/images/upload/product/thumbs/img_68da996a88715.png", desc: "Giúp làm sạch dịu nhẹ, cải thiện tình trạng rôm sảy, hăm da, mẩn ngứa." },
        { name: "Dung dịch vệ sinh cho bé", cat: "Dung dịch vệ sinh cho bé", href: "dung-dich-ve-sinh-cho-be-pro9.html", img: "assets/images/upload/product/thumbs/img_68ddda7c9a06e.png", desc: "Giúp làm sạch nhẹ nhàng, khử mùi hôi, làm dịu da bé khi bị rôm sảy, hăm da, mẩn ngứa." },
        { name: "Dung dịch vệ sinh cho bé", cat: "Dung dịch vệ sinh cho bé", href: "dung-dich-ve-sinh-cho-be-pro8.html", img: "assets/images/upload/product/thumbs/img_68ddda7c9a06e.png", desc: "Giúp làm sạch nhẹ nhàng, khử mùi hôi, làm dịu da bé khi bị rôm sảy, hăm da, mẩn ngứa." },
        { name: "Dung dịch vệ sinh cho bé", cat: "Dung dịch vệ sinh cho bé", href: "dung-dich-ve-sinh-cho-be-pro7.html", img: "assets/images/upload/product/thumbs/img_68ddda7c9a06e.png", desc: "Giúp làm sạch nhẹ nhàng, khử mùi hôi, làm dịu da bé khi bị rôm sảy, hăm da, mẩn ngứa." },
        { name: "Dung dịch vệ sinh cho bé", cat: "Dung dịch vệ sinh cho bé", href: "dung-dich-ve-sinh-cho-be-pro6.html", img: "assets/images/upload/product/thumbs/img_68db4f93f32fc.png", desc: "Hương mùa xuân & Vương Quốc Hạnh Phúc." },
        { name: "Dung dịch vệ sinh cho bé", cat: "Dung dịch vệ sinh cho bé", href: "dung-dich-ve-sinh-cho-be-pro5.html", img: "assets/images/upload/product/thumbs/img_68db4f7810eb3.png", desc: "Hương mùa xuân & Vương Quốc Hạnh Phúc." },
        { name: "Nước giặt thảo mộc", cat: "Nước giặt thảo mộc", href: "nuoc-giat-thao-moc-pro4.html", img: "assets/images/upload/product/thumbs/img_68ddda8e43e4c.png", desc: "Hương mùa xuân & vương quốc Hạnh Phúc." },
        { name: "Nước giặt thảo mộc", cat: "Nước giặt thảo mộc", href: "nuoc-giat-thao-moc-pro3.html", img: "assets/images/upload/product/thumbs/img_68ddda9c1c982.png", desc: "Hương mùa xuân & vương quốc Hạnh Phúc." },
        { name: "Nước tắm thảo dược", cat: "Nước tắm thảo dược", href: "nuoc-tam-thao-duoc-pro2.html", img: "assets/images/upload/product/thumbs/img_68da996a88715.png", desc: "Giúp làm sạch dịu nhẹ, cải thiện tình trạng rôm sảy, hăm da, mẩn ngứa." },
        { name: "Dung dịch vệ sinh cho bé", cat: "Dung dịch vệ sinh cho bé", href: "dung-dich-ve-sinh-cho-be-pro1.html", img: "assets/images/upload/product/thumbs/img_68ddda7c9a06e.png", desc: "Giúp làm sạch nhẹ nhàng, khử mùi hôi, làm dịu da bé khi bị rôm sảy, hăm da, mẩn ngứa." }
    ];

    function removeDiacritics(str) {
        return str
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, "")
            .replace(/đ/g, "d")
            .replace(/Đ/g, "D")
            .toLowerCase();
    }

    function escapeHtml(str) {
        return str.replace(/[&<>"']/g, function (m) {
            return { "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[m];
        });
    }

    function cardHtml(p) {
        return (
            '<div class="col-md-3 col-6">' +
            '<div class="box-item" data-aos="fade-left">' +
            '<a href="' + p.href + '">' +
            '<div class="img"><img src="' + p.img + '" alt="' + escapeHtml(p.name) + '"/></div>' +
            '<div class="info">' +
            '<h4 class="title text-truncate">' + escapeHtml(p.name) + '</h4>' +
            '<div class="desc"><p>' + escapeHtml(p.desc) + '</p></div>' +
            '<div class="btn-themes">Xem thêm <img src="assets/images/right-arrow.svg" alt=""/></div>' +
            '</div></a></div></div>'
        );
    }

    function render(list) {
        var grid = document.getElementById("searchGrid");
        var empty = document.getElementById("searchEmpty");
        var status = document.getElementById("searchStatus");
        if (!grid) return;

        if (list.length === 0) {
            grid.innerHTML = "";
            empty.classList.remove("d-none");
            status.textContent = "";
            return;
        }
        empty.classList.add("d-none");
        grid.innerHTML = list.map(cardHtml).join("");
        status.textContent = "Tìm thấy " + list.length + " sản phẩm";
    }

    function filter(keyword, cat) {
        var kw = removeDiacritics((keyword || "").trim());
        return PRODUCTS.filter(function (p) {
            var matchCat = cat === "all" || p.cat === cat;
            if (!matchCat) return false;
            if (!kw) return true;
            var haystack = removeDiacritics(p.name + " " + p.desc + " " + p.cat);
            return haystack.indexOf(kw) !== -1;
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        var input = document.getElementById("searchInput");
        var clearBtn = document.getElementById("searchClear");
        var tags = document.querySelectorAll(".tag-chip");
        var activeCat = "all";

        function run() {
            render(filter(input.value, activeCat));
        }

        // Đọc từ khoá truyền qua URL: tim-kiem.html?keyword=...
        var params = new URLSearchParams(window.location.search);
        if (params.get("keyword")) {
            input.value = params.get("keyword");
        }

        input.addEventListener("input", run);

        clearBtn.addEventListener("click", function () {
            input.value = "";
            input.focus();
            run();
        });

        tags.forEach(function (btn) {
            btn.addEventListener("click", function () {
                tags.forEach(function (b) { b.classList.remove("active"); });
                btn.classList.add("active");
                activeCat = btn.getAttribute("data-cat");
                run();
            });
        });

        run();
    });
})();

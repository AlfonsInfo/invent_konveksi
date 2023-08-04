  //* Data Table Attributes
  $('#example2').DataTable({
    "paging": true,
    "search" : true,
    "lengthChange": false,
    "search": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });


    //* Data Table Attributes
    $('#example3').DataTable({
        "paging": true,
        "pageLength" : 2,
        "search" : true,
        "lengthChange": false,
        "search": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    


  //* Delete Attributes
  // Menangani peristiwa klik tombol Delete
  document.addEventListener("click", function (e) {
      if (e.target && e.target.classList.contains("delete-btn")) {
          e.preventDefault();
          const attributeId = e.target.getAttribute("data-attribute-id");
          console.log(attributeId); // 

          // Tampilkan SweetAlert untuk konfirmasi
          Swal.fire({
              title: "Apakah Anda yakin ingin menghapus atribut ini?",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, delete it!",
          }).then((result) => {
              if (result.isConfirmed) {
                  fetch("/delete/attributes/" + attributeId, {
                      method: "DELETE",
                      headers: {
                          "Content-Type": "application/json",
                      },
                  })
                  .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    if (data.status === 'success') {
                        Swal.fire({
                            title: "Success",
                            text: data.message,
                            icon: "success",
                        }).then(() => {
                            window.location.reload();
                        });
                    } else if (data.status === 'error') {
                        Swal.fire({
                            title: "Error",
                            text: data.message,
                            icon: "error",
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire({
                        title: "Error",
                        text: "Terjadi kesalahan saat menghapus data!",
                        icon: "error",
                    });
                });
              }
          });
      }
  });


   // Menangani peristiwa klik tombol Delete
   document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("delete-btn-atd")) {
        e.preventDefault();
        const detailsId = e.target.getAttribute("data-details-id");
        console.log(detailsId); // 

        // Tampilkan SweetAlert untuk konfirmasi
        Swal.fire({
            title: "Apakah Anda yakin ingin menghapus nilai ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("/delete/attributedetails/" + detailsId, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                    },
                })
                .then((response) => {
                  return response.json();
              })
              .then((data) => {
                  if (data.status === 'success') {
                      Swal.fire({
                          title: "Success",
                          text: data.message,
                          icon: "success",
                      }).then(() => {
                          window.location.reload();
                      });
                  } else if (data.status === 'error') {
                      Swal.fire({
                          title: "Error",
                          text: data.message,
                          icon: "error",
                      });
                  }
              })
              .catch((error) => {
                  console.error("Error:", error);
                  Swal.fire({
                      title: "Error",
                      text: "Terjadi kesalahan saat menghapus data!",
                      icon: "error",
                  });
              });
            }
        });
    }
});


  // Menangani peristiwa klik tombol Delete
  document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("delete-btn-brand")) {
        e.preventDefault();
        const brandId = e.target.getAttribute("data-brand-id");
        console.log(brandId); // 

        // Tampilkan SweetAlert untuk konfirmasi
        Swal.fire({
            title: "Apakah Anda yakin ingin menghapus brand ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("/delete/brands/" + brandId, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                    },
                })
                .then((response) => {
                  return response.json();
              })
              .then((data) => {
                  if (data.status === 'success') {
                      Swal.fire({
                          title: "Success",
                          text: data.message,
                          icon: "success",
                      }).then(() => {
                          window.location.reload();
                      });
                  } else if (data.status === 'error') {
                      Swal.fire({
                          title: "Error",
                          text: data.message,
                          icon: "error",
                      });
                  }
              })
              .catch((error) => {
                  console.error("Error:", error);
                  Swal.fire({
                      title: "Error",
                      text: "Terjadi kesalahan saat menghapus data!",
                      icon: "error",
                  });
              });
            }
        });
    }



    if (e.target && e.target.classList.contains("delete-btn-category")) {
        e.preventDefault();
        const categoryId = e.target.getAttribute("data-category-id");
        console.log(categoryId); // 
    
        // Tampilkan SweetAlert untuk konfirmasi
        Swal.fire({
            title: "Apakah Anda yakin ingin menghapus kategori ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("/delete/productcategory/" + categoryId, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                    },
                })
                .then((response) => {
                  return response.json();
              })
              .then((data) => {
                  if (data.status === 'success') {
                      Swal.fire({
                          title: "Success",
                          text: data.message,
                          icon: "success",
                      }).then(() => {
                          window.location.reload();
                      });
                  } else if (data.status === 'error') {
                      Swal.fire({
                          title: "Error",
                          text: data.message,
                          icon: "error",
                      });
                  }
              })
              .catch((error) => {
                  console.error("Error:", error);
                  Swal.fire({
                      title: "Error",
                      text: "Terjadi kesalahan saat menghapus data!",
                      icon: "error",
                  });
              });
            }
        });
    }
});
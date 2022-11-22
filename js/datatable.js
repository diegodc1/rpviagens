// Table to vechicle list

$(document).ready(function() {
  $('#listSelectUsers').DataTable({
    
      scrollY: '50vh',
      scrollX: '98%',
      // columnDefs: [
      //       {
      //           target: 5,
      //           searchable: false,
      //       },
      //   ],
      searching: false,
      "search": {
        // "smart": false,
        "search": " ",
        // "return": true,
      },
      paging: false,
      "language": {
          "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
      },

      
  });
});


function pushId() {
  $user
}

// Table to dashboard list
$(document).ready(function() {
  $('#listDashboard').DataTable({
      scrollY: '15rem',
      scrollX: '40rem',
      scrollCollapse: true,
      paging: false,
      searching: false,
      info: false,
      ordering: false,
      "autoWidth": false,
      "language": {
          "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
      },
      
  });
});


// Table to checkin list
$(document).ready(function() {
  $('#listSe').DataTable({
      scrollY: '18rem',
      scrollCollapse: true,
      paging: false,
      info: false,
      ordering: false,
      "autoWidth": false,
      "language": {
          "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
      },
      
  });
});

// Table to checkout list
$(document).ready(function() {
  $('#listSelecters').DataTable({

      scrollCollapse: true,
      info: false,
      ordering: false,
      "autoWidth": false,
      "language": {
          "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
      },
      
  });
});



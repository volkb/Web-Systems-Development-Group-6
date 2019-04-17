
function getName(users, rin){
  var name = "";
  for (var i =  0; i < users.length; i++){
    if (users[i]['rin'] == rin){
      name = users[i]['firstName'] + " " + users[i]['lastName'];
    }
    if (name.length > 14){
      name = users[i]['firstName'] + " " + users[i]['lastName'].substring(0, 1) + ".";
    }
  }
  return name;
}

function getPrettyDate(time){
  //Day
  var day = time.toDateString().substring(0,3);

  //Hours
  var dd = "am";
  var hours = time.getHours();
  if (hours >= 12){
    hours = hours - 12;
    dd = "pm";
  }
  if (hours == 0){
    hours = 12;
  }

  //Minutes
  var minutes = (time.getMinutes() < 10? '0' : '') + time.getMinutes();

  //AM or PM


  //Format return
  var ret = "";
  ret += day + " ";
  ret += hours + ":";
  ret += minutes + " ";
  ret += dd;
  return ret;
}

function fetchMachines(machineReturn){
    return $.ajax({
        method: "POST",
        url: "controllers/machines_controller.php",
        success: function(data){
            machineReturn(JSON.parse(data));
        }
    });
};

function fetchProjects(projectsReturn){
    return $.ajax({
        method: "POST",
        url: "controllers/projects_controller.php",
        success: function(data){
            projectsReturn(JSON.parse(data));
        }
    });
};

function fetchUsers(usersReturn){
  return $.ajax({
      method: "POST",
      url: "controllers/users_controller.php",
      success: function(data){
          usersReturn(JSON.parse(data));
      }
  });
};

function createStatusBars() {
    fetchMachines(function(machines){
      fetchProjects(function(projects){
        fetchUsers(function(users){
          var machine_change = [];
          for(var i=0;i<machines.length;i++){

            // Loop through each machine and create a card and initialize their progress bar
            if(typeof machines[i] !== "undefined"){

              // Check if the current print of the machine is failed.
              var failed_print = false;
              for (var k = 0; k<projects.length; k++){
                if (projects[k]['machine'] == machines[i]['machineName'] && projects[k]['timesFailed'] != 0 && projects[k]['endTime'] == null){
                  failed_print = true;
                }
              }

              // If Machine Out Of Order
              if (machines[i]['status'] == 0){
                machine_change[i] = 'ooo';
                if(i == 0){
                  $('#statuses').append("<div class='row' id='temp_row'></div>");
                }else if (i % 8 == 0){
                  $('#temp_row').removeAttr('id');
                  $('#statuses').append("<div class='row' id='temp_row'></div>");
                }
                var id = machines[i]['machineName'].replace(/[^a-zA-Z ]/g, "").replace(/^[0-9]+/g, '').replace(/\s/g, '');
                $('#temp_row').append("<div class='col mx-2 my-2 p-0'><div class='card shadow-lg  status-bar-card-width-TV'><div class='status-bar-card-height-TV card-body position-relative'><h5 class='card-title text-center'><strong>" +machines[i]['machineName'] + "</strong></h5><hr class='m-0' /><div class='text-center' id=\"" + id + "\"><p class=' m-0 p-0 text-center'><font size='3'><strong>Temporarily Out of Service.</strong></font></p></div><div class='ldBar label-center no-label w-100 h-25 fixed-bottom position-absolute' id='" + id + "_percentage'></div></div></div></div>");
                var bar1 = new ldBar('#'+id + '_percentage',{
                  'preset': 'stripe',
                  'fill': 'data:ldbar/res,stripe(#DC3545,#E15361, 0)'
                });
                bar1.set(100, false);
              }

              // If print is failed
              else if (failed_print){
                machine_change[i] = 'failed';
                if(i == 0){
                  $('#statuses').append("<div class='row' id='temp_row'></div>");
                }else if (i % 8 == 0){
                  $('#temp_row').removeAttr('id');
                  $('#statuses').append("<div class='row' id='temp_row'></div>");
                }
                var id = machines[i]['machineName'].replace(/[^a-zA-Z ]/g, "").replace(/^[0-9]+/g, '').replace(/\s/g, '');
                $('#temp_row').append("<div class='col mx-2 my-2 p-0'><div class='card shadow-lg  status-bar-card-width-TV'><div class='status-bar-card-height-TV card-body position-relative'><h5 class='card-title text-center'><strong>" +machines[i]['machineName'] + "</strong></h5><hr class='m-0' /><div id=\"" + id + "\"></div><div class='ldBar label-center w-100 h-25 fixed-bottom position-absolute' id='" + id + "_percentage'></div></div></div></div>");
                var bar1 = new ldBar('#'+id + '_percentage',{
                  'preset': 'stripe',
                  'fill': 'data:ldbar/res,stripe(#FFC107,#FFD553, 2)'
                });
                bar1.set(0);
              }

              // If Machine Not in Use
              else if (machines[i]['inUse'] == 0){
                machine_change[i] = 'free';
                if(i == 0){
                  $('#statuses').append("<div class='row' id='temp_row'></div>");
                }else if (i % 8 == 0){
                  $('#temp_row').removeAttr('id');
                  $('#statuses').append("<div class='row' id='temp_row'></div>");
                }
                var id = machines[i]['machineName'].replace(/[^a-zA-Z ]/g, "").replace(/^[0-9]+/g, '').replace(/\s/g, '');
                $('#temp_row').append("<div class='col status-bar-card-width-TV mx-2 my-2 p-0 '><div class='card shadow-lg  status-bar-card-width-TV'><div class='status-bar-card-height-TV card-body position-relative'><h5 class='card-title text-center'><strong>" +machines[i]['machineName'] + "</strong></h5><hr class='m-0' /><div id=\"" + id + "\"></div><div class='ldBar label-center no-label w-100 h-25 fixed-bottom position-absolute' id='" + id + "_percentage'></div></div></div></div>");
                var bar1 = new ldBar('#'+id + '_percentage',{
                  'preset': 'stripe',
                  'fill': 'data:ldbar/res,stripe(#CCCCCC,#D4D4D4, 0)'
                });
                bar1.set(100, false);
              }

              // If Machine is in use
              else {
                machine_change[i] = 'inuse';
                if(i == 0){
                  $('#statuses').append("<div class='row' id='temp_row'></div>");
                }else if (i % 8 == 0){
                  $('#temp_row').removeAttr('id');
                  $('#statuses').append("<div class='row' id='temp_row'></div>");
                }
                var id = machines[i]['machineName'].replace(/[^a-zA-Z ]/g, "").replace(/^[0-9]+/g, '').replace(/\s/g, '');
                $('#temp_row').append("<div class='col mx-2 my-2 p-0'><div class='card shadow-lg  status-bar-card-width-TV'><div class='status-bar-card-height-TV card-body position-relative'><h5 class='card-title text-center'><strong>" +machines[i]['machineName'] + "</strong></h5><hr class='m-0' /><div id=\"" + id + "\"></div><div class='ldBar label-center w-100 h-25 fixed-bottom position-absolute' id='" + id + "_percentage'></div></div></div></div>");
                var bar1 = new ldBar('#'+id + '_percentage',{
                  'preset': 'stripe',
                  'fill': 'data:ldbar/res,stripe(#28A745,#48B461, 2)'
                });
                bar1.set(0);
              }
            }
          }

          //initial call
          updateStatusBars(machines, projects, users, machine_change);

          //repeating call
          setInterval(function () {
            fetchMachines(function (m) {
              fetchProjects(function (p) {
                fetchUsers(function (u) {
                  updateStatusBars(m, p, u, machine_change);
                })
              })
            })
          }, 1500) //every 3 seconds
        });
      });
    });
}

function updateStatusBars(machines, projects, users, change) {

    //for every machine
    for (var i = 0; i < machines.length; i++) {

        if (typeof machines[i] !== "undefined") {

            //variable to hold "[machineName]_percentage"
            var id = machines[i]['machineName'].replace(/[^a-zA-Z ]/g, "").replace(/^[0-9]+/g, '').replace(/\s/g, '');
            var elem = document.getElementById(id + '_percentage');
            var el = document.getElementById(id);


            // Machine out of order
            if (machines[i]['status'] == 0) {
              // wasn't out of order, but now is
              if (change[i] != 'ooo'){
                change[i] = 'ooo';
                $('#' + id + "_percentage").remove();
                $('#' + id).after("<div class='ldBar label-center no-label w-100 h-25 fixed-bottom position-absolute' id='" + id + "_percentage'></div>");
                var b = new ldBar('#'+id + '_percentage',{
                  'preset': 'stripe',
                  'fill': 'data:ldbar/res,stripe(#DC3545,#C44D58, 0)'
                });
                b.set(100);
                el.innerHTML="";
              }
            }

            //if machine is able to print
            else {

                //currently not in use
                if (machines[i]['inUse'] == 0) {
                  // wasn't not in use, now isn't
                  if (change[i] != 'free'){
                    change[i] = 'free';
                    $('#' + id + "_percentage").remove();
                    $('#' + id).after("<div class='ldBar label-center no-label w-100 h-25 fixed-bottom position-absolute' id='" + id + "_percentage'></div>");
                    var b = new ldBar('#'+id + '_percentage',{
                      'preset': 'stripe',
                      'fill': 'data:ldbar/res,stripe(#CCCCCC,#D4D4D4, 0)'
                    });
                    b.set(100);
                    el.innerHTML="";
                  }
                }

                //currently in use, inUse == 1
                else {

                    //for the details of the project being printed
                    var matchedProject;

                    //look through every project
                    for (var j = 0; j < projects.length; j++){
                        //TODO: ACCOUNT FOR COMPLETED PROJECTS, MAKE SURE THEY DONT PASS THIS IF STATEMENT
                        if (!projects[j]['endTime']) {
                            if (projects[j]['machine'] === machines[i]['machineName']) {
                                matchedProject = projects[j];
                                var name = getName(users, projects[j]['userID']);
                                var start = new Date(matchedProject['startTime']);
                                var eta = new Date(matchedProject['eta']);
                                var startDate = getPrettyDate(start);
                                var endDate = getPrettyDate(eta);
                                var current = new Date();

                                // Project is currently failed
                                if (projects[j]['timesFailed'] != 0){
                                  // Project wasn't failed but now it is.
                                  if (change[i] != 'failed'){
                                    change[i] = 'failed';
                                    el.innerHTML = "<p class='m-1'>Name: <font size='3'><span class='align-right float-right'><strong>" + name + "</strong></span></font><br/>Started: <font size='3'><span class='align-right float-right'><strong>" +  startDate + "</strong></span></font><br/>End: <font size='3'><span class='align-right float-right'><strong>"+ endDate +"</strong></span></font></p>";
                                      $('#' + id + "_percentage").remove();
                                      $('#' + id).after("<div class='ldBar label-center w-100 h-25 fixed-bottom position-absolute' id='" + id + "_percentage'></div>");
                                      var b = new ldBar('#'+id + '_percentage',{
                                        'preset': 'stripe',
                                        'fill': 'data:ldbar/res,stripe(#FFC107,#FFD553, 2)'
                                      });
                                      var totalTime = eta-start;
                                      var timeElapsed = current-start;
                                      var percentage = timeElapsed / totalTime * 100;
                                      elem.ldBar.set(percentage);
                                  }
                                  // Project remains failed.
                                  else {
                                    // 1 hours is up
                                    if (current > eta) {
                                      el.innerHTML = "<p class='m-1'>Name: <font size='3'><span class='align-right float-right'><strong>" + name + "</strong></span></font><br/>Started: <font size='3'><span class='align-right float-right'><strong>" +  startDate + "</strong></span></font><br/>End: <font size='3'><span class='align-right float-right'><strong>"+ endDate +"</strong></span></font></p><p class=' m-0 p-0 text-center'><font size='3'><strong>Machine to be freed.</strong></font></p>";
                                      elem.ldBar.set(100);
                                    }
                                    // 1 hour in progress
                                    else {
                                        el.innerHTML = "<p class='m-1'>Name: <font size='3'><span class='align-right float-right'><strong>" + name + "</strong></span></font><br/>Started: <font size='3'><span class='align-right float-right'><strong>" +  startDate + "</strong></span></font><br/>End: <font size='3'><span class='align-right float-right'><strong>"+ endDate +"</strong></span></font></p><p class=' m-0 p-0 text-center'><font size='3'><strong>Print Failed!</strong></font></p>";
                                        var totalTime = eta-start;
                                        var timeElapsed = current-start;
                                        var percentage = timeElapsed / totalTime * 100;
                                        elem.ldBar.set(percentage);
                                    }
                                  }
                                }

                                // Machine wasn't in use, but now is
                                else if (change[i] != 'inuse'){
                                  change[i] = 'inuse';
                                  el.innerHTML = "<p class='m-1'>Name: <font size='3'><span class='align-right float-right'><strong>" + name + "</strong></span></font><br/>Started: <font size='3'><span class='align-right float-right'><strong>" +  startDate + "</strong></span></font><br/>End: <font size='3'><span class='align-right float-right'><strong>"+ endDate +"</strong></span></font></p>";
                                  $('#' + id + "_percentage").remove();
                                  $('#' + id).after("<div class='ldBar label-center w-100 h-25 fixed-bottom position-absolute' id='" + id + "_percentage'></div>");
                                  var b = new ldBar('#'+id + '_percentage',{
                                    'preset': 'stripe',
                                    'fill': 'data:ldbar/res,stripe(#28A745,#48B461, 2)'
                                  });
                                  var totalTime = eta-start;
                                  var timeElapsed = current-start;
                                  var percentage = timeElapsed / totalTime * 100;
                                  elem.ldBar.set(percentage);
                                }

                                // Machine remains in use
                                else{
                                  // Project is complete
                                  if (current > eta) {
                                    el.innerHTML = "<p class='m-1'>Name: <font size='3'><span class='align-right float-right'><strong>" + name + "</strong></span></font><br/>Started: <font size='3'><span class='align-right float-right'><strong>" +  startDate + "</strong></span></font><br/>End: <font size='3'><span class='align-right float-right'><strong>"+ endDate +"</strong></span></font></p><p class=' m-0 p-0 text-center'><font size='3'><strong>Complete!</strong></font></p>";
                                    elem.ldBar.set(100);
                                  }
                                  // Project in Progress
                                  else {
                                      el.innerHTML = "<p class='m-1'>Name: <font size='3'><span class='align-right float-right'><strong>" + name + "</strong></span></font><br/>Started: <font size='3'><span class='align-right float-right'><strong>" +  startDate + "</strong></span></font><br/>End: <font size='3'><span class='align-right float-right'><strong>"+ endDate +"</strong></span></font></p>";
                                      var totalTime = eta-start;
                                      var timeElapsed = current-start;
                                      var percentage = timeElapsed / totalTime * 100;
                                      elem.ldBar.set(percentage);
                                  }
                                }
                                break;
                            }
                        }
                    }
                }
            }
        }

    }

}

$(document).ready(function(){
    createStatusBars();
});

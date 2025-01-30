// Wait for DOM to be ready and ensure slimScroll is available
$(document).ready(function() {
	if(!$.fn.slimScroll) {
		console.warn('slimScroll plugin not loaded');
		return;
	}

	// Custom Scroll
	$('.customScroll').slimScroll({
		height: "180px",
		color: '#e5e8f2',
		alwaysVisible: false,
		size: "4px",
		distance: '1px',
		railVisible: false,
		railColor: "#0066bf",
	});

	// Custom Scroll 2
	$('.customScroll2').slimScroll({
		height: "227px",
		color: '#ffffff',
		alwaysVisible: false,
		size: "4px",
		distance: '1px',
		railVisible: false,
		railColor: "#ffffff",
	});

	// Custom Scroll 3
	$('.customScroll3').slimScroll({
		height: "218px",
		color: '#ffffff',
		alwaysVisible: false,
		size: "4px",
		distance: '1px',
		railVisible: false,
		railColor: "#ffffff",
	});

	// Custom Scroll 4
	$('.customScroll4').slimScroll({
		height: "310px",
		color: '#ffffff',
		alwaysVisible: false,
		size: "4px",
		distance: '1px',
		railVisible: false,
		railColor: "#ffffff",
	});

	// Custom Scroll 5
	$('.customScroll5').slimScroll({
		height: "250px",
		color: '#ffffff',
		alwaysVisible: false,
		size: "4px",
		distance: '1px',
		railVisible: false,
		railColor: "#ffffff",
	});

	// Custom Scroll
	$('.sidebarNavScroll').slimScroll({
		height: "calc(100vh - 250px)",
		color: '#17202b',
		alwaysVisible: false,
		size: "4px",
		distance: '1px',
		railVisible: false,
		railColor: "#0066bf",
		position: 'left',
	});

	// Chat App Page
	// Chat Container Scroll
	$('.usersContainerScroll').slimScroll({
		height: "100%",
		color: '#e6ecf3',
		alwaysVisible: false,
		size: "4px",
		distance: '1px',
		railVisible: false,
		railColor: "#e6ecf3",
	});
	// Chat Users Container Scroll
	$('.chatContainerScroll').slimScroll({
		height: "100%",
		color: '#e6ecf3',
		alwaysVisible: false,
		size: "4px",
		distance: '1px',
		railVisible: false,
		railColor: "#e6ecf3",
	});

	// Tasks App Page
	// Tasks Labels Container Scroll
	$('.lablesContainerScroll').slimScroll({
		height: "100%",
		color: '#e6ecf3',
		alwaysVisible: false,
		size: "4px",
		distance: '1px',
		railVisible: false,
		railColor: "#e6ecf3",
		position: 'left',
	});
	// Tasks Container Scroll
	$('.tasksContainerScroll').slimScroll({
		height: "100%",
		color: '#e6ecf3',
		alwaysVisible: false,
		size: "4px",
		distance: '1px',
		railVisible: false,
		railColor: "#e6ecf3",
	});

	// Documents App Page
	// Documents Labels Container Scroll
	$('.docTypeContainerScroll').slimScroll({
		height: "100%",
		color: '#e6ecf3',
		alwaysVisible: false,
		size: "4px",
		distance: '1px',
		railVisible: false,
		railColor: "#e6ecf3",
		position: 'left',
	});
	// Documents Container Scroll
	$('.documentsContainerScroll').slimScroll({
		height: "100%",
		color: '#e6ecf3',
		alwaysVisible: false,
		size: "4px",
		distance: '1px',
		railVisible: false,
		railColor: "#e6ecf3",
	});

	$('.hotelMapScroll').slimScroll({
		height: "350px",
		color: '#e5e8f2',
		alwaysVisible: false,
		size: "4px",
		distance: '1px',
		railVisible: false,
		railColor: "#e5e8f2",
	});

	$('.projectLog').slimScroll({
		height: "170px",
		color: '#e5e8f2',
		alwaysVisible: false,
		size: "4px",
		distance: '1px',
		railVisible: false,
		railColor: "#e5e8f2",
	});

	$('.fullHeight').slimScroll({
		height: "100%",
		color: '#e5e8f2',
		alwaysVisible: false,
		size: "4px",
		distance: '1px',
		railVisible: false,
		railColor: "#e5e8f2",
		position: 'left',
	});

	// Fixed Body Scroll
	$('.fixedBodyScroll').slimScroll({
		height: "100%",
		color: '#c7cdd4',
		alwaysVisible: false,
		size: "4px",
		distance: '3px',
		railVisible: false,
		railColor: "#c7cdd4",
	});
});

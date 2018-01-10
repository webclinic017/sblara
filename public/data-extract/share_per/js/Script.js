var divContent = null;
var divHeaderRow = null;
var divHeaderColumn = null;
var divHeaderRowColumn = null;
var headerRowFirstColumn = null;
var x;
var y;
var horizontal = false;
var vertical = false;

// Copy table to top and to left
function CreateScrollHeader(content, scrollHorizontal, scrollVertical)
{
	horizontal = scrollHorizontal;
	vertical = scrollVertical;
	
	if (content != null)
	{
		divContent = content;
		var headerRow = divContent.childNodes[0].childNodes[0].childNodes[0];
		x = divContent.childNodes[0].offsetWidth;
		y = divContent.childNodes[0].offsetHeight;		

		divHeaderRow = divContent.cloneNode(true);		
		if (horizontal)
		{
			divHeaderRow.style.height = headerRow.offsetHeight;
			divHeaderRow.style.overflow = "hidden";
			
			divContent.parentNode.insertBefore(divHeaderRow, divContent);
			divContent.childNodes[0].style.position = "absolute";
			divContent.childNodes[0].style.top = "-" + headerRow.offsetHeight;
			
			y = y - headerRow.offsetHeight;
		}
		
		divHeaderRowColumn = divHeaderRow.cloneNode(true);			
		headerRowFirstColumn = headerRow.childNodes[0];
		divHeaderColumn = divContent.cloneNode(true);
		divContent.style.position = "relative";

		if (vertical)
		{
			divContent.parentNode.insertBefore(divHeaderColumn, divContent);
			divContent.style.left = headerRowFirstColumn.offsetWidth;
			
			divContent.childNodes[0].style.position = "absolute";
			divContent.childNodes[0].style.left = "-" + headerRowFirstColumn.offsetWidth;
		}
		else
		{
			divContent.style.left = 0;
		}
						
		if (vertical)
		{
			divHeaderColumn.style.width = headerRowFirstColumn.offsetWidth;
			divHeaderColumn.style.overflow = "hidden";
			divHeaderColumn.style.zIndex = "99";
			
			divHeaderColumn.style.position = "absolute";
			divHeaderColumn.style.left = "0";
			addScrollSynchronization(divHeaderColumn, divContent, "vertical");
			x = x - headerRowFirstColumn.offsetWidth;
		}
		
		if (horizontal)
		{
			if (vertical)
			{
				divContent.parentNode.insertBefore(divHeaderRowColumn, divContent);
			}
			divHeaderRowColumn.style.position = "absolute";
			divHeaderRowColumn.style.left = "0";
			divHeaderRowColumn.style.top = "0";
			divHeaderRowColumn.style.width = headerRowFirstColumn.offsetWidth;
			divHeaderRowColumn.overflow = "hidden";
			divHeaderRowColumn.style.zIndex = "100";
			divHeaderRowColumn.style.backgroundColor = "#ffffff";
			
		}
		
		if (horizontal)
		{
			addScrollSynchronization(divHeaderRow, divContent, "horizontal");
		}
		
		if (horizontal || vertical)
		{
			window.onresize = ResizeScrollArea;
			ResizeScrollArea();
		}
	}
}


// Resize scroll area to window size.
function ResizeScrollArea()
{
	var height = document.documentElement.clientHeight - 120;
	if (!vertical)
	{
		height -= divHeaderRow.offsetHeight;
	}
	var width = document.documentElement.clientWidth - 50;
	if (!horizontal)
	{
		width -= divHeaderColumn.offsetWidth;
	}
	var headerRowsWidth = 0;
	divContent.childNodes[0].style.width = x;
	divContent.childNodes[0].style.height = y;
	
	if (divHeaderRowColumn != null)
	{
		headerRowsWidth = divHeaderRowColumn.offsetWidth;
	}

	// width
	if (divContent.childNodes[0].offsetWidth > width)
	{
		divContent.style.width = Math.max(width - headerRowsWidth, 0);
		divContent.style.overflowX = "scroll";
		divContent.style.overflowY = "auto";
	}
	else
	{
		divContent.style.width = x;
		divContent.style.overflowX = "auto";
		divContent.style.overflowY = "auto";
	}

	if (divHeaderRow != null)
	{
		divHeaderRow.style.width = divContent.offsetWidth + headerRowsWidth;
	}

	// height
	if (divContent.childNodes[0].offsetHeight > height)
	{
		divContent.style.height = Math.max(height, 80);
		divContent.style.overflowY = "scroll";
	}
	else
	{
		divContent.style.height = y;
		divContent.style.overflowY = "hidden";
	}
	if (divHeaderColumn != null)
	{
		divHeaderColumn.style.height = divContent.offsetHeight;
	}

	// check scrollbars
	if (divContent.style.overflowY == "scroll")
	{
		divContent.style.width = divContent.offsetWidth + 17;
	}
	if (divContent.style.overflowX == "scroll")
	{
		divContent.style.height = divContent.offsetHeight + 17;
	}

	divContent.parentElement.style.width = divContent.offsetWidth + headerRowsWidth;
}


// ********************************************************************************
// Synchronize div elements when scrolling 
// from http://webfx.eae.net/dhtml/syncscroll/syncscroll.html
// ********************************************************************************
// This is a function that returns a function that is used
// in the event listener
function getOnScrollFunction(oElement) {
	return function () {
		if (oElement._scrollSyncDirection == "horizontal" || oElement._scrollSyncDirection == "both")
			oElement.scrollLeft = event.srcElement.scrollLeft;
		if (oElement._scrollSyncDirection == "vertical" || oElement._scrollSyncDirection == "both")
			oElement.scrollTop = event.srcElement.scrollTop;
	};

}

// This function adds scroll syncronization for the fromElement to the toElement
// this means that the fromElement will be updated when the toElement is scrolled
function addScrollSynchronization(fromElement, toElement, direction) {
	removeScrollSynchronization(fromElement);
	
	fromElement._syncScroll = getOnScrollFunction(fromElement);
	fromElement._scrollSyncDirection = direction;
	fromElement._syncTo = toElement;
	toElement.attachEvent("onscroll", fromElement._syncScroll);
}

// removes the scroll synchronization for an element
function removeScrollSynchronization(fromElement) {
	if (fromElement._syncTo != null)
		fromElement._syncTo.detachEvent("onscroll", fromElement._syncScroll);

	fromElement._syncTo = null;
	fromElement._syncScroll = null;
	fromElement._scrollSyncDirection = null;
}



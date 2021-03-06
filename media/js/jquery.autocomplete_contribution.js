// Limit scope pollution from any deprecated API
(function() {

    var matched, browser;

    // Use of jQuery.browser is frowned upon.
    // More details: http://api.jquery.com/jQuery.browser
    // jQuery.uaMatch maintained for back-compat
    jQuery.uaMatch = function( ua ) {
        ua = ua.toLowerCase();

        var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
        /(webkit)[ \/]([\w.]+)/.exec( ua ) ||
        /(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
        /(msie) ([\w.]+)/.exec( ua ) ||
        ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
        [];

        return {
            browser: match[ 1 ] || "",
            version: match[ 2 ] || "0"
        };
    };

    matched = jQuery.uaMatch( navigator.userAgent );
    browser = {};

    if ( matched.browser ) {
        browser[ matched.browser ] = true;
        browser.version = matched.version;
    }

    // Chrome is Webkit, but Webkit is also Safari.
    if ( browser.chrome ) {
        browser.webkit = true;
    } else if ( browser.webkit ) {
        browser.safari = true;
    }

    jQuery.browser = browser;

    jQuery.sub = function() {
        function jQuerySub( selector, context ) {
            return new jQuerySub.fn.init( selector, context );
        }
        jQuery.extend( true, jQuerySub, this );
        jQuerySub.superclass = this;
        jQuerySub.fn = jQuerySub.prototype = this();
        jQuerySub.fn.constructor = jQuerySub;
        jQuerySub.sub = this.sub;
        jQuerySub.fn.init = function init( selector, context ) {
            if ( context && context instanceof jQuery && !(context instanceof jQuerySub) ) {
                context = jQuerySub( context );
            }

            return jQuery.fn.init.call( this, selector, context, rootjQuerySub );
        };
        jQuerySub.fn.init.prototype = jQuerySub.fn;
        var rootjQuerySub = jQuerySub(document);
        return jQuerySub;
    };

})();

jQuery.autocomplete = function(input, options) {
    // Create a link to self
    var me = this;
       

    // Create jQuery object for input element
    var $input = $(input).attr("autocomplete", "off");

    // Apply inputClass if necessary
    if (options.inputClass) $input.addClass(options.inputClass);

    // Create results
    var results = document.createElement("div");
    // Create jQuery object for results
    var $results = $(results);
    $results.hide().addClass(options.resultsClass).css("position", "absolute");
    if( options.width > 0 ) $results.css("width", options.width);

    // Add to body element
    $("body").append(results);

    input.autocompleter = me;

    var timeout = null;
    var prev = "";
    var active = -1;
    var cache = {};
    var keyb = false;
    var hasFocus = false;
    var lastKeyPressCode = null;

    // flush cache
    function flushCache(){
        cache = {};
        cache.data = {};
        cache.length = 0;
    };

    // flush cache
    flushCache();

    // if there is a data array supplied
    if( options.data != null ){
        var sFirstChar = "", stMatchSets = {}, row = [];

        // no url was specified, we need to adjust the cache length to make sure it fits the local data store
        if( typeof options.url != "string" ) options.cacheLength = 1;

        // loop through the array and create a lookup structure
        for( var i=0; i < options.data.length; i++ ){
            // if row is a string, make an array otherwise just reference the array
            row = ((typeof options.data[i] == "string") ? [options.data[i]] : options.data[i]);

            // if the length is zero, don't add to list
            if( row[0].length > 0 ){
                // get the first character
                sFirstChar = row[0].substring(0, 1).toLowerCase();
                // if no lookup array for this character exists, look it up now
                if( !stMatchSets[sFirstChar] ) stMatchSets[sFirstChar] = [];
                // if the match is a string
                stMatchSets[sFirstChar].push(row);
            }
        }

        // add the data items to the cache
        for( var k in stMatchSets ){
            // increase the cache size
            options.cacheLength++;
            // add to the cache
            addToCache(k, stMatchSets[k]);
        }
    }

    $input
    .keydown(function(e) {
        // track last key pressed
        lastKeyPressCode = e.keyCode;
        switch(e.keyCode) {
            case 38: // up
                e.preventDefault();
                moveSelect(-1);
                break;
            case 40: // down
                e.preventDefault();
                moveSelect(1);
                break;
            case 9:  // tab
            case 13: // return
                if( selectCurrent() ){
                    // make sure to blur off the current field
                    $input.get(0).blur();
                    e.preventDefault();
                }
                break;
            default:
                active = -1;
                if (timeout) clearTimeout(timeout);
                timeout = setTimeout(function(){
                    onChange();
                }, options.delay);
                break;
        }
    })
    .focus(function(){
        // track whether the field has focus, we shouldn't process any results if the field no longer has focus
        hasFocus = true;
    })
    .blur(function() {
        // track whether the field has focus
        hasFocus = false;
        hideResults();
    });

    hideResultsNow();

    function onChange() {
        // ignore if the following keys are pressed: [del] [shift] [capslock]
        if( lastKeyPressCode == 46 || (lastKeyPressCode > 8 && lastKeyPressCode < 32) ) return $results.hide();
        var v = $input.val();
        if (v == prev) return;
        prev = v;
        if (v.length >= options.minChars) {
            $input.addClass(options.loadingClass);
            requestData(v);
        } else {
            $input.removeClass(options.loadingClass);
            $results.hide();
        }
    };

    function moveSelect(step) {

        var lis = $("li", results);
        if (!lis) return;

        active += step;

        if (active < 0) {
            active = 0;
        } else if (active >= lis.size()) {
            active = lis.size() - 1;
        }

        lis.removeClass("ac_over");

        $(lis[active]).addClass("ac_over");

    // Weird behaviour in IE
    // if (lis[active] && lis[active].scrollIntoView) {
    // 	lis[active].scrollIntoView(false);
    // }

    };

    function selectCurrent() {
        var li = $("li.ac_over", results)[0];
        if (!li) {
            var $li = $("li", results);
            if (options.selectOnly) {
                if ($li.length == 1) li = $li[0];
            } else if (options.selectFirst) {
                li = $li[0];
            }
        }
        if (li) {
            selectItem(li);
            return true;
        } else {
            return false;
        }
    };

    function selectItem(li) {
            
        if (!li) {
            li = document.createElement("li");
            li.extra = [];
            li.selectValue = "";
        }
        var v = $.trim(li.selectValue ? li.selectValue : li.innerHTML);
        input.lastSelected = v;
        showPersonData(v);
               
               
        prev = v;
        $results.html("");
        $input.val(v);
        hideResultsNow();
        if (options.onItemSelect) setTimeout(function() {
            options.onItemSelect(li)
        }, 1);
    };

    // selects a portion of the input string
    function createSelection(start, end){
        // get a reference to the input element
        var field = $input.get(0);
        if( field.createTextRange ){
            var selRange = field.createTextRange();
            selRange.collapse(true);
            selRange.moveStart("character", start);
            selRange.moveEnd("character", end);
            selRange.select();
        } else if( field.setSelectionRange ){
            field.setSelectionRange(start, end);
        } else {
            if( field.selectionStart ){
                field.selectionStart = start;
                field.selectionEnd = end;
            }
        }
        field.focus();
    };

    // fills in the input box w/the first match (assumed to be the best match)
    function autoFill(sValue){
        // if the last user key pressed was backspace, don't autofill
        if( lastKeyPressCode != 8 ){
            // fill in the value (keep the case the user has typed)
            $input.val($input.val() + sValue.substring(prev.length));
            // select the portion of the value not typed by the user (so the next character will erase)
            createSelection(prev.length, sValue.length);
        }
    };

    function showResults() {
        // get the position of the input field right now (in case the DOM is shifted)
        var pos = findPos(input);
        // either use the specified width, or autocalculate based on form element
        var iWidth = (options.width > 0) ? options.width : $input.width();
        // reposition
        $results.css({
            width: parseInt(iWidth) + "px",
            top: (pos.y + input.offsetHeight) + "px",
            left: pos.x + "px"
        }).show();
    };

    function hideResults() {
        if (timeout) clearTimeout(timeout);
        timeout = setTimeout(hideResultsNow, 200);
    };

    function hideResultsNow() {
        if (timeout) clearTimeout(timeout);
        $input.removeClass(options.loadingClass);
        if ($results.is(":visible")) {
            $results.hide();
        }
        if (options.mustMatch) {
            var v = $input.val();
            if (v != input.lastSelected) {
                selectItem(null);
            }
        }
    };

    function receiveData(q, data) {
        if (data) {
            $input.removeClass(options.loadingClass);
            results.innerHTML = "";

            // if the field no longer has focus or if there are no matches, do not display the drop down
            if( !hasFocus || data.length == 0 ) return hideResultsNow();

            if ($.browser.msie) {
                // we put a styled iframe behind the calendar so HTML SELECT elements don't show through
                $results.append(document.createElement('iframe'));
            }
            results.appendChild(dataToDom(data));
            // autofill in the complete box w/the first match as long as the user hasn't entered in more data
            if( options.autoFill && ($input.val().toLowerCase() == q.toLowerCase()) ) autoFill(data[0][0]);
            showResults();
        } else {
            hideResultsNow();
        }
    };

    function parseData(data) {
        if (!data) return null;
        var parsed = [];
        var rows = data.split(options.lineSeparator);
        for (var i=0; i < rows.length; i++) {
            var row = $.trim(rows[i]);
            if (row) {
                parsed[parsed.length] = row.split(options.cellSeparator);
            }
        }
        return parsed;
    };

    function dataToDom(data) {
        var ul = document.createElement("ul");
        var num = data.length;

        // limited results to a max number
        if( (options.maxItemsToShow > 0) && (options.maxItemsToShow < num) ) num = options.maxItemsToShow;

        for (var i=0; i < num; i++) {
            var row = data[i];
            if (!row) continue;
            var li = document.createElement("li");
            if (options.formatItem) {
                li.innerHTML = options.formatItem(row, i, num);
                li.selectValue = row[0];
            } else {
                li.innerHTML = row[0];
                li.selectValue = row[0];
            }
            var extra = null;
            if (row.length > 1) {
                extra = [];
                for (var j=1; j < row.length; j++) {
                    extra[extra.length] = row[j];
                }
            }
            li.extra = extra;
            ul.appendChild(li);
            $(li).hover(
                function() {
                    $("li", ul).removeClass("ac_over");
                    $(this).addClass("ac_over");
                    active = $("li", ul).indexOf($(this).get(0));
                },
                function() {
                    $(this).removeClass("ac_over");
                }
                ).click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                selectItem(this)
            });
        }
        return ul;
    };

    function requestData(q) {
        if (!options.matchCase) q = q.toLowerCase();
        var data = options.cacheLength ? loadFromCache(q) : null;
        // recieve the cached data
        if (data) {
            receiveData(q, data);
        // if an AJAX url has been supplied, try loading the data now
        } else if( (typeof options.url == "string") && (options.url.length > 0) ){
            $.get(makeUrl(q), function(data) {
                data = parseData(data);
                addToCache(q, data);
                receiveData(q, data);
            });
        // if there's been no data found, remove the loading class
        } else {
            $input.removeClass(options.loadingClass);
        }
    };

    function makeUrl(q) {
        var url = options.url + "?q=" + encodeURI(q);
        for (var i in options.extraParams) {
            url += "&" + i + "=" + encodeURI(options.extraParams[i]);
        }
        return url;
    };

    function loadFromCache(q) {
        if (!q) return null;
        if (cache.data[q]) return cache.data[q];
        if (options.matchSubset) {
            for (var i = q.length - 1; i >= options.minChars; i--) {
                var qs = q.substr(0, i);
                var c = cache.data[qs];
                if (c) {
                    var csub = [];
                    for (var j = 0; j < c.length; j++) {
                        var x = c[j];
                        var x0 = x[0];
                        if (matchSubset(x0, q)) {
                            csub[csub.length] = x;
                        }
                    }
                    return csub;
                }
            }
        }
        return null;
    };

    function matchSubset(s, sub) {
        if (!options.matchCase) s = s.toLowerCase();
        var i = s.indexOf(sub);
        if (i == -1) return false;
        return i == 0 || options.matchContains;
    };

    this.flushCache = function() {
        flushCache();
    };

    this.setExtraParams = function(p) {
        options.extraParams = p;
    };

    this.findValue = function(){
        var q = $input.val();

        if (!options.matchCase) q = q.toLowerCase();
        var data = options.cacheLength ? loadFromCache(q) : null;
        if (data) {
            findValueCallback(q, data);
        } else if( (typeof options.url == "string") && (options.url.length > 0) ){
            $.get(makeUrl(q), function(data) {
                data = parseData(data)
                addToCache(q, data);
                findValueCallback(q, data);
            });
        } else {
            // no matches
            findValueCallback(q, null);
        }
    }
       
    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
        
    function showPersonData(value){
        var npid = value.split("-");
        var pid = npid[0];
        if(pid.length > 0){
            $('#member_info').html(options.pleasewait);
            $.ajax({
                url:options.serverURLq,
                type:'POST',
                data:{
                    value:pid,
                    column :options.column
                },                              
                success: function(data){
                    var json = JSON.parse(data);
                    if(json['success'].toString() == 'N'){
                        $('#member_info').html('<div style="color:red;">'+json['error'].toString()+'</div>');
                    }else{
                        var userdata = json['data'];
                        var contact = json['contact'];
                        var balance = json['balance'];
                        if(options.column == 'PID'){
                            $("#"+options.secondID).val(userdata["member_id"]);
                        }else if(options.column == 'MID'){
                            $("#"+options.secondID).val(userdata["PID"]); 
                        }
                        var output = '<div style="border:1px solid  #ccc;font-size:15px;"><table style="width:100%;"><tr><td style="width:70%;">';
                        output += '<div style="border-bottom:1px dashed #ccc;"><strong>'+options.Name+' : </strong> '+userdata["firstname"]+' '+userdata["middlename"]+' '+userdata["lastname"]+'</div>';
                        output += '<div style="border-bottom:1px dashed #ccc;"><strong>'+options.gender+' : </strong> '+userdata["gender"]+'</div>';
                        output += '<div style="border-bottom:1px dashed #ccc;"><strong>'+options.dob+' : </strong> '+userdata["dob"]+'</div>';
                        output += '<div style="border-bottom:1px dashed #ccc;"><strong>'+options.joindate+' : </strong> '+userdata["joiningdate"]+'</div>';
                        output += '<div style="border-bottom:1px dashed #ccc;"><strong>'+options.phone1+': </strong> '+contact["phone1"]+'</div>';
                        output += '<div style="border-bottom:1px dashed #ccc;"><strong>'+options.phone2+' : </strong> '+contact["phone2"]+'</div>';
                        output += '<div style="border-bottom:1px dashed #ccc;"><strong>'+options.email+' : </strong> '+contact["email"]+'</div>';
                        output +='</td><td>  <img style=" height:120px;" src="'+options.photourl+userdata["photo"].toString()+'"/></td></tr></table>       </div>';
                        output += '<br/><br/><div style="border-bottom:1px dashed #ccc; font-size:25px;"><strong>'+options.balance_share+' : </strong> '+balance+'</div>';
                        $('#member_info').html(output);   
                    }
                        
                        
                },
                error:function(xhr,textStatus,errorThrown){
                    alert(errorThrown); 
                }
            });
          
        }
    }
    
      

    function findValueCallback(q, data){
        if (data) $input.removeClass(options.loadingClass);

        var num = (data) ? data.length : 0;
        var li = null;

        for (var i=0; i < num; i++) {
            var row = data[i];

            if( row[0].toLowerCase() == q.toLowerCase() ){
                li = document.createElement("li");
                if (options.formatItem) {
                    li.innerHTML = options.formatItem(row, i, num);
                    li.selectValue = row[0];
                } else {
                    li.innerHTML = row[0];
                    li.selectValue = row[0];
                }
                var extra = null;
                if( row.length > 1 ){
                    extra = [];
                    for (var j=1; j < row.length; j++) {
                        extra[extra.length] = row[j];
                    }
                }
                li.extra = extra;
            }
        }

        if( options.onFindValue ) setTimeout(function() {
            options.onFindValue(li)
        }, 1);
    }

    function addToCache(q, data) {
        if (!data || !q || !options.cacheLength) return;
        if (!cache.length || cache.length > options.cacheLength) {
            flushCache();
            cache.length++;
        } else if (!cache[q]) {
            cache.length++;
        }
        cache.data[q] = data;
    };

    function findPos(obj) {
        var curleft = obj.offsetLeft || 0;
        var curtop = obj.offsetTop || 0;
        while (obj = obj.offsetParent) {
            curleft += obj.offsetLeft
            curtop += obj.offsetTop
        }
        return {
            x:curleft,
            y:curtop
        };
    }
}

jQuery.fn.autocomplete = function(url, options, data) {
    // Make sure options exists
    options = options || {};
    // Set url as option
    options.url = url;
    // set some bulk local data
    options.data = ((typeof data == "object") && (data.constructor == Array)) ? data : null;

    // Set default values for required options
    options.inputClass = options.inputClass || "ac_input";
    options.resultsClass = options.resultsClass || "ac_results";
    options.lineSeparator = options.lineSeparator || "\n";
    options.cellSeparator = options.cellSeparator || "|";
    options.minChars = options.minChars || 1;
    options.delay = options.delay || 400;
    options.matchCase = options.matchCase || 0;
    options.matchSubset = options.matchSubset || 1;
    options.matchContains = options.matchContains || 0;
    options.cacheLength = options.cacheLength || 1;
    options.mustMatch = options.mustMatch || 0;
    options.extraParams = options.extraParams || {};
    options.loadingClass = options.loadingClass || "ac_loading";
    options.selectFirst = options.selectFirst || false;
    options.selectOnly = options.selectOnly || false;
    options.maxItemsToShow = options.maxItemsToShow || -1;
    options.autoFill = options.autoFill || false;
    options.width = parseInt(options.width, 10) || 0;
    options.serverURLq = options.serverURLq || 0;
    options.pleasewait = options.pleasewait || 0;
    options.secondID = options.secondID || 0;
    options.Name = options.Name || 0;
    options.gender = options.gender || 0;
    options.dob = options.dob || 0;
    options.joindate = options.joindate || 0;
    options.phone1 = options.phone1 || 0;
    options.phone2 = options.phone2 || 0;
    options.email = options.email || 0;
    options.photourl = options.photourl || 0;
    options.column = options.column || 'PID';
    options.balance_share = options.balance_share || '';
    options.total_shareamount =  options.total_shareamount || 0;
    options.min_share = options.min_share || 0;
    options.max_share = options.max_share || 0;
    options.remainshare = options.remainshare || 0;
                        
    this.each(function() {
        var input = this;
        new jQuery.autocomplete(input, options);
    });

    // Don't break the chain
    return this;
}

jQuery.fn.autocompleteArray = function(data, options) {
    return this.autocomplete(null, options, data);
}

jQuery.fn.indexOf = function(e){
    for( var i=0; i<this.length; i++ ){
        if( this[i] == e ) return i;
    }
    return -1;
};

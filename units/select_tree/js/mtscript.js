function SelectTree() {
	this.div_filter = '.j-select_tree_block';
	this.select_sign = '.j-select_tree';
	this.option_sign = '.j-option_select_tree';
	this.default_source = 'childs';
	
	var self = this;
	var i = 0;
	$$(this.div_filter).each(function (div) {
		self.initSelect(i, div);
		i++;
	});
}
SelectTree.prototype.initSelect = function(i, div) {
	div.innerHTML = '';
	var d = div, id = this._getId(d).replace('get_', '');
	var input = Element('input');
	input.type = 'hidden';
	input.name = input.id = id;
	$(d).grab(input, 'bottom');
	d.setAttribute('data-n', i);
	
	
	var a =  this._getId(d), self = this, data = {parent_id:0, i:i};
	var stored = localStorage.getItem('categories'), i;
	if (stored) {
		try {
			stored = JSON.parse(stored);
			
			var store = stored.store;
			for (var j = 0; j < store.length; j++) {
				console.log( store[j].items );
				var select = self.createSelect(store[j].items, $(document.body).getElement('div[data-n=' + i + ']'));
				if (select) {
					selectByValue(select, store[j].value);
				}
			}
			input.value = stored.value;
		} catch(e) {console.log(e);}
	} else {
		window.req(
			data,
			function(response) {
				self.createSelect(response.list, $(document.body).getElement('div[data-n=' + response.i + ']'));
			}, 
			function(){},
			a
		);
		
	}
	
	
};
SelectTree.prototype._getId = function(div) {
	var a = div.getAttribute('data-source');
	a = a ? a : this.default_source;
	return 'get_' + a;
};
SelectTree.prototype.createSelect = function(data, $div) {
	if (!data.length) {
		return null;
	}
	this.select_template = '<select class=""><option value="-1">' + 'Ничего не выбрано' + '</option></select>';
	var $select = Element('select'), a =  this._getId($div), i, j = 1, select, self = this;
	$select.setAttribute('class', 'j-select_tree');
	$select.options[0] = new Option('Ничего не выбрано', -1);
	select = $select;
	
	//$div.append($select);
	$($div).grab($select, 'bottom');
	
	for (i in data) {
		if (data[i].id) {
			select.options[j] = new Option(data[i].name, data[i].id);
			j++;
		}
	}
	$select.addEvent('change', 
		function(evt) {
			var select = this, found = 0, value = select.value,  store = [];
			$(select.parentNode).getElements('input[type=hidden]')[0].value = select.value;
			//$div.find('select').each(
			$div.getElements('select').each(
				function removeOldSelects(sel){
					if (sel == select) {
						found = 1;
						return;
					}
					if (found) {
						$(sel).remove();
					}
				}
			);
			window.req(
				{parent_id:select.value},
				function(response) {
					self.createSelect(response.list,  $div);
					
					//store selected value
					$div.getElements('select').each(function(sel){
						var i, obj, items = [];
						for (i = 0; i < sel.options.length; i++) {
							obj = {id:sel.options[i].value, name:sel.options[i].text};
							items.push(obj);
						}
						store.push({items:items, value:sel.value});
					});
					localStorage.setItem('categories', JSON.stringify({store:store, value:value}));
				}, 
				function(){},
				self._getId($div)
			);
		}
	);
	return select;
	
};

(
    function() {
		$(window).addEvent('DOMContentLoaded', init);
		function init() {
			new SelectTree();
		}
	}
)()

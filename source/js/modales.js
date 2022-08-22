// Modal LG
function modal_lg(title,body,footer,form = "") {
  form_header = "";
  form_footer = "";
  if (form != "") {
    form_header = form;
    form_footer = "</form>"
  }
  let modal_lg = '';
  modal_lg += 
  '<div class="modal fade" role="dialog" id="modal-js">' +
  '<div class="modal-dialog modal-lg">' +
  '<div class="modal-content">' +
  '<div class="modal-header">' +
  '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
  '<h4 class="modal-title">'+title+'</h4>' +
  '</div>' 
  +form_header+
  '<div class="modal-body">'
    +body+
  '</div>' +
  '<div class="modal-footer">'
    +footer+
  '</div>' 
  +form_footer+
  '</div>' +
  '</div>' +
  '</div>' +
  '</div>';
  return modal_lg;
}
// Modal default
function modal(title,body,footer,form = "") {
  form_header = "";
  form_footer = "";
  if (form != "") {
    form_header = form;
    form_footer = "</form>"
  }
  modal_de = '';
  modal_de += 
  '<div class="modal fade" role="dialog" id="modal-js">' +
  '<div class="modal-dialog">' +
  '<div class="modal-content">' +
  '<div class="modal-header">' +
  '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
  '<h4 class="modal-title">'+title+'</h4>' +
  '</div>' 
  +form_header+
  '<div class="modal-body">'
    +body+
  '</div>' +
  '<div class="modal-footer">'
    +footer+
  '</div>' 
  +form_footer+
  '</div>' +
  '</div>' +
  '</div>' +
  '</div>';
  return modal_de;
}

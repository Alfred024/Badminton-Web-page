function custom_alert(title = 'Title', content = 'Content default.', type = 'blue', columnClass = 'large') {
    $.alert({
        'title': title,
        'content': content,
        'type': type,
        'columnClass': columnClass,
    });
}
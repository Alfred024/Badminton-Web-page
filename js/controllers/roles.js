function roles(action) {
    
    switch (action) {
        case 'formEdit':
        case 'formNew':
            $.dialog({
                title: 'Agregar Rol',
                content: 'url: ../../classes/class_role.php?action=formNew',
                type: 'green'
            });
            break;
        case 'create':
            break;
        case 'update':
            break;
        case 'read':
            break;
        case 'delete':
            break;
        default:
            break;
    }
}
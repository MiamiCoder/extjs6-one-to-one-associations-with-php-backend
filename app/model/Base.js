Ext.define('App.model.Base', {
    extend: 'Ext.data.Model',
    idProperty: 'employeeNumber',
    fields: [
        { name: 'employeeNumber', type: 'int' },
        { name: 'lastName', type: 'string' },
        { name: 'firstName', type: 'string' }
    ],
    schema: {
        namespace: 'App.model',  
        proxy: {     
            type: 'ajax',
            url: '{entityName}s.php',
            reader: {
                type: 'json',
                rootProperty: '{entityName:lowercase}s'
            }
        }
    }
});
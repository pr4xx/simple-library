module.exports = (urlPrefix, urlSuffix = null) => {
    return (data, type, row) => {
        if (!data) {
            return data;
        }

        let uri = url(urlPrefix + '/' + row.id);
        if(urlSuffix) {
            uri += '/' + urlSuffix;
        }
        return '<a href="' + uri + '" title="' + data + '">'
            + data
            + '</a>';
    };
};
module.exports = (data, type, row) => {
    if(data) {
        let date = moment(data);

        return date.format('DD.MM.YYYY');
    }

    return '';
};
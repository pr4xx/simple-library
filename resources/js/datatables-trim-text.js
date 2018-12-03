module.exports = (length = 100) => {
    return (data, type, row) => {
        if (!data) {
            return data;
        }

        return data.substring(0, length) + '...';
    };
};
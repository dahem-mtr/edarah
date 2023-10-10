const useItemsUtils = () => {
    
    const isArray = (payload) => {
        return typeof payload === "object";
    };

    const onAction = (action, itemsModalRef) => {
        if (action.withConfirm) {
            itemsModalRef.open(action);
        } else {
            visit(action);
        }
    };
    const onConfirm = (action, itemsModalRef, inertia) => {
        itemsModalRef.close();
        visit(action, inertia);
    };

    const visit = (action, inertia) => {
        if (action.route) {
            let actionType = action.type ? action.type.toLowerCase() : "get";
            inertia[actionType](action.route);
        } else {
            window.location = action.url;
        }
    };

    const itemsUtils = { isArray, onConfirm, onAction, visit };
    return { itemsUtils };
};

export default useItemsUtils;

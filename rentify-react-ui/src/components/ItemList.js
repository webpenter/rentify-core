import React from 'react';

const ItemList = () => {
    return (
        <div className="w-2/5 bg-white p-4 overflow-y-auto">
            <div className="mb-4">
                <h2 className="text-lg font-bold">Inbox</h2>
            </div>
            <ul>
                <li className="p-4 border-b border-gray-200">
                    <span className="font-bold">Sender</span> - Email subject preview
                </li>
                <li className="p-4 border-b border-gray-200">
                    <span className="font-bold">Sender</span> - Email subject preview
                </li>
                {/* Add more emails as needed */}
            </ul>
        </div>
    );
};

export default ItemList;

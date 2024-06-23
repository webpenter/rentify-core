import React from 'react';

const ItemContent = () => {
    return (
        <div className="w-2/5 bg-gray-50 p-4">
            <div className="mb-4">
                <h2 className="text-lg font-bold">Email Subject</h2>
                <p>From: sender@example.com</p>
                <p>To: recipient@example.com</p>
            </div>
            <div>
                <p>Email content goes here...</p>
            </div>
        </div>
    );
};

export default ItemContent;

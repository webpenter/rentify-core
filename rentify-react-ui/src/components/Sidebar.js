import React from 'react';

const Sidebar = () => {
    return (
        <div className="w-1/5 bg-gray-100 p-4">
            <button className="bg-blue-500 text-white px-4 py-2 mb-4 rounded">Compose</button>
            <ul>
                <li className="mb-2">Inbox</li>
                <li className="mb-2">Starred</li>
                <li className="mb-2">Sent Mail</li>
                <li className="mb-2">Drafts</li>
            </ul>
        </div>
    );
};

export default Sidebar;

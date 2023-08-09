import React from "react";

export default function UserList(props) {
  return (
    <ol className="text-3xl list-decimal list-inside">
      {props.users.map((user, index) => {
        return (
          <li key={index}>
            {user.username}
            <div>
              <a href={`/edit/${user.id}`} className="m-8">
                Edytuj {user.id}
              </a>
              <button onClick={() => props.handleDelete(user.id)}>Usuń</button>
            </div>
          </li>
        );
      })}
    </ol>
  );
}

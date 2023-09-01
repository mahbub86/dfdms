import React from "react";

export const Button = (props) => {
  return (
    <button
      onClick={() => {
        props.onClick();
      }}
      // className={props.class}
      className={props.disabled ? "btnDisable" : props.class}
      disabled={props.disabled}
    >
      {props.label}
    </button>
  );
};

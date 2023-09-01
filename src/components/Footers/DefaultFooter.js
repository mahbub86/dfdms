/*eslint-disable*/
import React from "react";
import { Link } from "react-router-dom";

// reactstrap components
import { Container } from "reactstrap";

// core components

function DefaultFooter() {
  return (
    <>
      <footer className="footer footer-default">
        <Container>
          <nav>
            <ul>
              <li>
                <a href="http://192.241.155.223/" target="_blank" className="text-capitalize">
                Benin SVDL
                </a>
              </li>
            </ul>
          </nav>
          <div className="copyright" id="copyright">
            © {new Date().getFullYear()},{" "}
            <a
            // href=""
            // target="_blank"
            >
              Supported by GHSC-TA Francophone TO, Benin
            </a>
          </div>
        </Container>
      </footer>
    </>
  );
}

export default DefaultFooter;

import { css } from 'lit-element';
export const searcherStyles = css`
    .searcherB {
    border: none;
    background-color:  #5F8FB4;
    border-radius: 5px;
    cursor: pointer;
    height: 30px;
    width: 40px;
  }
  .searcherB:focus {
    outline: none;
  }
  .glass {
    color: whitesmoke;
  }
  .searcher {
    position: absolute;
    right: 70px;
    top: 22px;
    display: flex;
    align-items: center;
    z-index: 1;
  }
  .btn-wrp {
    margin-left: 10px;
  }
  .npt-wrp {
    height: 30px;
  }
  .npt-wrp input {
    height: inherit;
    border: 1px solid #D9D9D6;
    border-radius: 5px;
  }
`;
const unidecode = require('unidecode');

class Validator {
  static validateUser(phone, pass, fullname) {
    if (phone === "") {
      return { status: 'fall', errorPosition: "phone", mess: 'Số điện thoại không được để trống' };
    }

    if (pass === "") {
      return { status: 'fall', errorPosition: "pass", mess: 'Mật khẩu không được để trống' };
    }

    if (fullname === "") {
      return { status: 'fall', errorPosition: "fullname", mess: 'Họ tên không được để trống' };
    }

    if (!/^\d{10}$/.test(phone) || /[^a-zA-Z0-9]/.test(phone)) {
      return { status: 'fall', errorPosition: "phone", mess: 'Số điện thoại phải đúng định dạng và phải đủ 10 kí tự' };
    }

    const normalizedFullname = unidecode(fullname);

    if (!/^[a-zA-Z\s]{5,100}$/.test(normalizedFullname)) {
      return {
        status: 'fall',
        errorPosition: 'fullname',
        mess: 'Tên đầy đủ phải chỉ chứa ký tự không đặc biệt, có độ dài từ 5 đến 100 ký tự',
      };
    }

    return { status: 'success' };
  }
}

module.exports = Validator;

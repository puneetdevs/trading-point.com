// $(document).ready(function () {
//   var rules = {}
//   var messages = {}

//   $.each($('#form input, #form textarea'), function (index, field) {
//     if (field.name == 'first_name') {
//       rules[field.name] = {
//         required: true,
//         minlength: 3,
//         maxlength: 100,
//       }
//       messages[field.name] = {
//         required: 'Please enter your first name',
//         minlength: 'First name must be at least 2 characters',
//         maxlength: 'First name cannot be more than 50 characters',
//       }
//     }
//     if (field.name == 'last_name') {
//       rules[field.name] = {
//         required: true,
//         minlength: 2,
//         maxlength: 50,
//       }
//       messages[field.name] = {
//         required: 'Please enter your last name',
//         minlength: 'Last name must be at least 2 characters',
//         maxlength: 'Last name cannot be more than 50 characters',
//       }
//     }

//     if (field.name == 'position') {
//       rules[field.name] = {
//         required: true,
//         minlength: 2,
//         maxlength: 100,
//       }
//       messages[field.name] = {
//         required: 'Please enter your position',
//         minlength: 'Position must be at least 2 characters',
//         maxlength: 'Position cannot be more than 100 characters',
//       }
//     }

//     if (field.name == 'email') {
//       rules[field.name] = {
//         required: true,
//         email: true,
//       }
//       messages[field.name] = {
//         required: 'Please enter your email',
//         email: 'Please enter a valid email',
//       }
//     }
//     if (field.name == 'password') {
//       rules[field.name] = {
//         required: true,
//         minlength: 8,
//       }
//       messages[field.name] = {
//         required: 'Please enter a password',
//         minlength: 'Password must be at least 8 characters',
//       }
//     }
//     if (field.name == 'company_name') {
//       rules[field.name] = {
//         required: true,
//         minlength: 2,
//         maxlength: 100,
//       }
//       messages[field.name] = {
//         required: 'Please enter your company name',
//         minlength: 'Company name must be at least 2 characters',
//         maxlength: 'Company name cannot be more than 100 characters',
//       }
//     }
//     if (field.name == 'address') {
//       rules[field.name] = {
//         required: true,
//         minlength: 2,
//         maxlength: 200,
//       }
//       messages[field.name] = {
//         required: 'Please enter your address',
//         minlength: 'Address must be at least 2 characters',
//         maxlength: 'Address cannot be more than 200 characters',
//       }
//     }
//     if (field.name == 'phone_one') {
//       rules[field.name] = {
//         required: true,
//         minlength: 2,
//       }
//       messages[field.name] = {
//         required: 'Please enter your primary phone number',
//         phoneUS: 'Please enter a valid US phone number',
//       }
//     }
//     if (field.name == 'phone_two') {
//       rules[field.name] = {}
//       messages[field.name] = {
//         phoneUS: 'Please enter a valid US phone number',
//       }
//     }
//   })

//   $('#form').validate({
//     rules: rules,
//     messages: messages,
//   })
// })

// // $(document).ready(function () {
// //   $('#form').validate({
// //     rules: {
// //       first_name: {
// //         required: true,
// //         minlength: 3,
// //         maxlength: 100,
// //       },
// //       last_name: {
// //         required: true,
// //         minlength: 2,
// //         maxlength: 50,
// //       },
// //       position: {
// //         required: true,
// //         minlength: 2,
// //         maxlength: 100,
// //       },
// //       email: {
// //         required: true,
// //         email: true,
// //       },
// //       password: {
// //         required: true,
// //         minlength: 8,
// //       },
// //       company_name: {
// //         required: true,
// //         minlength: 2,
// //         maxlength: 100,
// //       },
// //       address: {
// //         required: true,
// //         minlength: 2,
// //         maxlength: 200,
// //       },
// //       phone_one: {
// //         required: true,
// //         minlength: 2,
// //       },
// //     },
// //     messages: {
// //       first_name: {
// //         required: 'Please enter your first name',
// //         minlength: 'First name must be at least 2 characters',
// //         maxlength: 'First name cannot be more than 50 characters',
// //       },
// //       last_name: {
// //         required: 'Please enter your last name',
// //         minlength: 'Last name must be at least 2 characters',
// //         maxlength: 'Last name cannot be more than 50 characters',
// //       },
// //       position: {
// //         required: 'Please enter your position',
// //         minlength: 'Position must be at least 2 characters',
// //         maxlength: 'Position cannot be more than 100 characters',
// //       },
// //       email: {
// //         required: 'Please enter your email',
// //         email: 'Please enter a valid email',
// //       },
// //       password: {
// //         required: 'Please enter a password',
// //         minlength: 'Password must be at least 8 characters',
// //       },
// //       company_name: {
// //         required: 'Please enter your company name',
// //         minlength: 'Company name must be at least 2 characters',
// //         maxlength: 'Company name cannot be more than 100 characters',
// //       },
// //       address: {
// //         required: 'Please enter your address',
// //         minlength: 'Address must be at least 2 characters',
// //         maxlength: 'Address cannot be more than 200 characters',
// //       },
// //       phone_one: {
// //         required: 'Please enter your primary phone number',
// //         phoneUS: 'Please enter a valid US phone number',
// //       },
// //       phone_two: {
// //         phoneUS: 'Please enter a valid US phone number',
// //       },
// //     },
// //   })
// // })

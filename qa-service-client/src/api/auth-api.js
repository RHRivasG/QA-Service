const url = __myapp.env.API_URL;

async function requestGeneric(pkg, method) {
  const res = await fetch(url + method, {
    method: "post",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(pkg),
  });
  const response = await res.json();
  return response;
}

export const loginApi = async (userLogin) =>
  await requestGeneric(userLogin, "login");
export const registerApi = async (userRegistered) =>
  await requestGeneric(userLogin, "register");

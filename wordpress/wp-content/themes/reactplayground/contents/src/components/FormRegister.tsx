import { useState } from "react"

const FormRegister = () => {
  const [form, setForm] = useState<any>(null)

  const handleSubmitForm = async (e: any) => {
    e.preventDefault();
    const data = form

    const formData = new FormData();

    // append action for admin-post
    formData.append('action', 'store_school');

    // loop through your object
    for (const key in data) {
      if (data.hasOwnProperty(key)) {
        formData.append(key, data[key]);
      }
    }
    const response = await fetch('/wp-admin/admin-ajax.php', {
      method: 'POST',
      body: formData,
    })

    const teest = await response.json();
    console.log({ response, teest })
  }
  return (
    <form onSubmit={handleSubmitForm}>
      <input type="text" placeholder="email" value={form?.email || ''} onChange={(e: any) => setForm({
        ...form,
        email: e.target.value })}/>
      <br/>
      <input type="text" placeholder="address" value={form?.address|| ''} onChange={(e: any) => setForm({
        ...form,
        address: e.target.value })}/>
      <br/>
      <br/>
      <input type="submit" value="Submit" />
    </form>
  )
}

export default FormRegister